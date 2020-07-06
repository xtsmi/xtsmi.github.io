<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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

            $page = Str::contains($route->getName(), 'feeds')
                ?  $route->getName() . '.xml'
                :  $page = $route->getName() . '.html';

            $request = Request::create($route->uri());

            $request->headers->set(
                'host',
                parse_url(config('app.url'), PHP_URL_HOST)
            );

            $response = app()->handle($request);

            Storage::put(
                $page,
                (string)$response->getContent()
            );

            $this->info("Page '$page' generated");
        }
    }
}
