<?php

namespace App\Console\Commands;

use App\News;
use App\Similar;
use Carbon\Carbon;
use Illuminate\Console\Command;
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
            ->map(static function (string $rss) {
                $elements = new \SimpleXMLElement($rss);

                $news = [];
                foreach ($elements->channel->item as $item) {

                    $pubDate = Carbon::parse((string)$item->pubDate);
                    $limit = now()->sub('1 day');

                    if (!$limit->lt($pubDate)) {
                        continue;
                    }

                    $news[(string)$item->link] = new News((array)$item);
                }

                return $news;
            })
            ->mapWithKeys(function ($news) {
                return $news;
            })
            ->sortBy('pubDate');

        $forSimilar = $rss
            ->pluck('title', 'link')
            ->toArray();


        $similar = Similar::build($forSimilar, 65)
            ->filter(function (array $group) {
                return count($group) > 2;
            });


        $rssArray = $rss->toArray();


        $lastNews = $similar
            ->keyBy(function (array $items, string $key) use ($rssArray) {
                return $rssArray[$key]['title'];
            })
            ->map(function (array $items) use ($rssArray) {
                return collect($items)->map(function ($item, $key) use ($rssArray) {
                    return $rssArray[$key];
                })->toArray();
            })->toJson();


        Storage::put('last-news.json', $lastNews);

        $this->info('Latest News Received');
    }
}
