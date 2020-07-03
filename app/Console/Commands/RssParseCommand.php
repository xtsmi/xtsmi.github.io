<?php

namespace App\Console\Commands;

use App\News;
use App\Similar;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class RssParseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rss:parse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $rss = collect(config('smi.rss'))
            ->map(function (string $url) {
                return Http::get($url)->body();
            })
            ->map(function (string $rss) {
                $elements = new \SimpleXMLElement($rss);

                $news = [];
                foreach ($elements->channel->item as $item) {
                    $model = $this->createModelForXMLElement($item);

                    if ($model === null) {
                        continue;
                    }

                    $news[$model->link] = $model;
                }

                return $news;
            })
            ->mapWithKeys(function ($news) {
                return $news;
            });

        $forSimilar = $rss
            ->pluck('title', 'link')
            ->toArray();


        $similar = Similar::build($forSimilar, 65)
            ->map(function (array $items) use ($rss) {
                return collect($items)
                    ->map(function ($item, $key) use ($rss) {
                        return $rss->get($key);
                    });
            })

            ->filter(function (Collection $items) {
                return $items->count() > 2;
            })
            ->filter(function (Collection $items){
                return $items->map(function (News $news) {
                        return parse_url($news->link, PHP_URL_HOST);
                    })
                        ->unique()
                        ->count() > 1;
            })
            ->map(function (Collection $items) {

                $fresh = $items->filter(function (News $news){
                    return now()->subHours(8)->isBefore($news->pubDate);
                });

                return $fresh->count() > 5 ? $fresh : $items;
            })
            ->keyBy(function (Collection $items) {
                return $items
                    ->sortBy('pubDate')
                    ->first()
                    ->title;
            });


        Storage::put('last-news.json', $similar->toJson());

        $this->info('Latest News Received');
    }


    /**
     * @param \SimpleXMLElement $item
     *
     * @return News|null
     */
    private function createModelForXMLElement(\SimpleXMLElement $item): ?News
    {
        $pubDate = Carbon::parse((string)$item->pubDate);

        if (now()->subDay()->isBefore($pubDate)) {
            return null;
        }

        return new News((array)$item);
    }
}
