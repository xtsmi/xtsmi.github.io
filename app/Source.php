<?php

namespace App;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\HigherOrderCollectionProxy;

class Source
{
    /**
     * @return Collection|HigherOrderCollectionProxy
     */
    public static function getSimilarNews()
    {
        return once(function () {
            return collect(self::getJsonData('/api/similar-news.json'))
                ->map(function (array $group) {

                    $main = new News($group['main']);

                    $items = collect($group['items'])->map(function ($new) {
                        return new News($new);
                    })->sortByDesc('pubDate');

                    return collect([
                        'main'  => $main,
                        'items' => $items,
                    ]);
                });
        });
    }

    /**
     * @return Collection|HigherOrderCollectionProxy
     */
    public static function getLastNews()
    {
        return once(function () {
            return collect(self::getJsonData('/api/last-news.json'))
                ->map(function (array $item) {
                    return new News($item);
                })
                ->sortByDesc('pubDate');
        });
    }

    /**
     * @return Collection|HigherOrderCollectionProxy
     */
    public static function getExchange()
    {
        return once(function () {
            return collect(self::getJsonData('/api/exchange.json'));
        });
    }

    /**
     * @param string $path
     *
     * @return array|mixed
     */
    private static function getJsonData(string $path)
    {
        if (!Storage::exists($path)) {
            return [];
        }

        return json_decode(
            Storage::get($path),
            true
        );
    }
}
