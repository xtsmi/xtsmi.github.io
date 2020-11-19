<?php

namespace App\Console\Commands;

use App\News;
use App\Robot\Client;
use GuzzleHttp\Psr7\Response;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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
     * @return News[]|Collection
     */
    private function transformRssToModels(string $rss): Collection
    {
        try {
            $elements = new \SimpleXMLElement($rss);
        } catch (\Exception $exception) {
            return collect();
        }

        $news = collect();

        if (isset($elements->channel->item)) {
            $suites = $elements->channel->item;
        }

        if (isset($elements->entry)) {
            $suites = $elements->entry;
        }

        foreach ($suites as $item) {
            $model = $this->createModelForXMLElement($item);

            if ($model === null) {
                continue;
            }

            $news->put($model->link, $model);
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
        $item = (array)$item;


        $item['description'] = $item['description'] ?? $item['content'] ?? null;
        $item['pubDate'] = $item['published'] ?? $item['pubDate'] ?? null;

        if($item['link'] instanceof \SimpleXMLElement){
            $item['link'] = (string) $item['link']['href'];
        }

        $validator = Validator::make($item, [
            'title'       => 'required|string',
            'pubDate'     => 'required|date',
            'link'        => 'required|string',
        ]);

        if ($validator->fails()) {
            return null;
        }

        $news = new News($item);

        $media = collect();

        $enclosure = $item['enclosure'] ?? [];

        collect(
            (array)$enclosure
        )->each(static function ($info) use ($media) {
            $media->push((array)$info);
        });

        $news->fill([
            'media' => $media
        ]);

        if ($news->pubDate->addHours(config('smi.period'))->isBefore(now())) {
            return null;
        }

        return $news;
    }
}
