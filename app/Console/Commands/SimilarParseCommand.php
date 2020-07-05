<?php

namespace App\Console\Commands;

use App\News;
use App\Similar;
use App\Source;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class SimilarParseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rss:similar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $rss = Source::getLastNews();


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
            ->filter(function (Collection $items) {
                return $items->map(function (News $news) {
                        return parse_url($news->link, PHP_URL_HOST);
                    })
                        ->unique()
                        ->count() > 1;
            })
            ->map(function (Collection $items) {

                $fresh = $items->filter(function (News $news) {
                    return $news->pubDate
                        ->addHours(8)
                        ->isAfter(now());
                });

                return $fresh->count() > 5 ? $fresh : $items;
            })
            ->keyBy(function (Collection $items) {
                return $items
                    ->sortBy('pubDate')
                    ->first()
                    ->title;
            });


        Storage::put('similar-news.json', $similar->toJson());

        $this->info('Similar News Received');
    }
}
