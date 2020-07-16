<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Response;

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

            /** @var Response $response */
            $response = app()->handle($request);

            if($response->status() !== 200){
                $this->warn("Url: $route->uri() response not 200");
            }

            Storage::put(
                $page,
                (string)$response->getContent()
            );

            Storage::put('/ap/generated.json',
                json_encode([
                    'generated' => config('smi.generated')
                ])
            );

            $this->info("Page '$page' generated");
        }
    }
}
