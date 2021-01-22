<?php

namespace App\Console\Commands;

use App\News;
use App\Source;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Tabuna\Similar\Similar;

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
        $start = microtime(true);

        $percent = config('smi.story.percent', 51);

        $similar = new Similar(function (News $a, News $b) use ($percent) {
            similar_text($a->title, $b->title, $copy);

            return $percent < $copy;
        });

        $data = $similar
            ->findOut(Source::getLastNews()->all())
            ->filter(function (Collection $items) {
                return $items->count() >= config('smi.story.minCount');
            })
            ->filter(function (Collection $items) {
                return $items->pluck('domain')->unique()->count() > 1;
            })
            ->map(function (Collection $group) {
                $main = $group->first();

                if ($main->image === null) {
                    $group->each(function (News $news) use (&$main) {
                        if ($news->image !== null) {
                            $main->media = $news->media;
                        }
                    });
                }

                return collect([
                    'main'  => $main,
                    'items' => $group,
                ]);
            })
            ->toJson();


        Storage::put('/api/similar-news.json', $data);

        $time = round(microtime(true) - $start, 2);
        $this->info("Similar News Received: $time sec.");
    }
}
