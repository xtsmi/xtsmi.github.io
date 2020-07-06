<?php


namespace App;


use Illuminate\Support\Facades\Storage;
use Illuminate\Support\HigherOrderCollectionProxy;
use Illuminate\Support\Collection;

class Source
{
    /**
     * @return Collection|HigherOrderCollectionProxy
     */
    public static function getSimilarNews()
    {
        if (!Storage::exists('/api/similar-news.json')) {
            return collect();
        }

        $similarNews = json_decode(Storage::get('/api/similar-news.json'), true);

        return collect($similarNews)
            ->map(function ($news) {
                return collect($news);
            })
            ->map->map(function ($new) {
                return new News($new);
            });
    }

    /**
     * @return Collection|HigherOrderCollectionProxy
     */
    public static function getLastNews(){

        if (!Storage::exists('/api/last-news.json')) {
            return collect();
        }

        $lastNews = Storage::get('/api/last-news.json');

        return collect(
            json_decode($lastNews, true)
        )->map(function (array $item) {
            return new News($item);
        })
            ->sortByDesc('pubDate');
    }
}
