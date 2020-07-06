<?php

namespace App\Console\Commands;

use App\News;
use App\Robot\Client;
use GuzzleHttp\Psr7\Response;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class DownloadRssCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rss:download';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Download last news';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $client = new Client();

        $rss = collect();

        $client->browse(config('smi.rss'), function (Response $response) use ($rss) {
            $rss->push($response->getBody());
        });

        $json = $rss->map(function (string $rss) {
            return $this->transformRssToModels($rss);
        })
            ->sortBy('pubDate')
            ->mapWithKeys(function ($news) {
                return $news;
            })
            ->toJson();

        Storage::put('/api/last-news.json', $json);

        $this->info('Latest News Received');
    }

    /**
     * @param string $rss
     *
     * @return News[]
     */
    private function transformRssToModels(string $rss): array
    {
        try {
            $elements = new \SimpleXMLElement($rss);
        } catch (\Exception $exception) {
            return [];
        }

        $news = [];

        foreach ($elements->channel->item as $item) {
            $model = $this->createModelForXMLElement($item);

            if ($model === null) {
                continue;
            }

            $news[$model->link] = $model;
        }

        return $news;
    }

    /**
     * @param \SimpleXMLElement $item
     *
     * @return News|null
     */
    private function createModelForXMLElement(\SimpleXMLElement $item): ?News
    {
        $news = new News((array)$item);

        if ($news->pubDate->addDay()->isBefore(now())) {
            return null;
        }

        return $news;
    }
}
