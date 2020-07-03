<?php

namespace App\Console\Commands;

use App\News;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class BuildPageCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rss:page';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate page';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $similarNews = json_decode(Storage::get('similar-news.json'), true);

        $news = collect($similarNews)
            ->map(function ($news) {
                return collect($news);
            })
            ->map->map(function ($new) {
                return new News($new);
            });


        $html = view('app', ['news' => $news])->render();

        Storage::put('index.html', $html);

        $this->info('Page generated');
    }
}
