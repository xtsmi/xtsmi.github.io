<?php

namespace App\Console\Commands;

use App\News;
use App\Source;
use Illuminate\Console\Command;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
        $this->generatedNewsPages()
            ->generatedStaticPage()
            ->generatedApi();
    }

    /**
     * @return $this
     */
    public function generatedApi(): BuildPageCommand
    {
        Storage::put('/api/generated.json',
            json_encode([
                'generated' => config('smi.generated'),
            ])
        );

        $this->info('Api generated');

        return $this;
    }

    /**
     * @return $this
     */
    public function generatedStaticPage(): BuildPageCommand
    {
        /** @var \Illuminate\Routing\Route $route */
        foreach (Route::getRoutes() as $route) {

            $page = Str::contains($route->getName(), 'feeds')
                ? $route->getName() . '.xml'
                : $page = $route->getName() . '.html';


            $response = $this->createRequest($route->uri());

            if ($response->status() !== 200) {
                $url = $route->uri();
                $this->warn("Url: $url response not 200");
            }

            Storage::put(
                $page,
                (string)$response->getContent()
            );

            $this->info("Page '$page' generated");
        }

        return $this;
    }

    /**
     * @return BuildPageCommand
     */
    public function generatedNewsPages(): BuildPageCommand
    {
        Source::getLastNews()->each(function (News $news) {
            $uri = route('news', $news->id);

            $response = $this->createRequest($uri);

            $page = parse_url($uri, PHP_URL_PATH) . '.html';

            Storage::put(
                $page,
                (string)$response->getContent()
            );
        });

        $this->info('News pages generated');

        return $this;
    }

    /**
     * @param string $uri
     *
     * @return Response
     */
    private function createRequest(string $uri): Response
    {
        $request = Request::create($uri);

        $request->headers->set(
            'host',
            parse_url(config('app.url'), PHP_URL_HOST)
        );

        /** @var Response $response */
        $response = app()->handle($request);

        if (is_a($response, RedirectResponse::class)) {
            return $this->createRequest($response->getTargetUrl());
        }

        /** @var Response $response */
        return app()->handle($request);
    }
}
