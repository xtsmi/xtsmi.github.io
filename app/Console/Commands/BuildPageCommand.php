<?php

namespace App\Console\Commands;

use App\Source;
use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\App;

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
        /** @var \Illuminate\Routing\Route $route */
        foreach (Route::getRoutes() as $route) {

            $page = $route->getName().'.html';

            $response = app()->handle(
                Request::create($route->uri())
            );

            Storage::put(
                $page,
                (string) $response->getContent()
            );

            $this->info("Page '$page' generated");
        }
    }
}
