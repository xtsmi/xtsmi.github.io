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
        $lastNews = json_decode(Storage::get('last-news.json'), true);

        $news = collect($lastNews)->map(function ($news) {
            return collect($news)->map(function ($new) {
                return new News($new);
            });
        });


        $html = view('app', ['news' => $news])->render();

        Storage::put('index.html', $html);

        $this->info('Page generated');
    }
}
