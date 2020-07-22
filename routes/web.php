<?php

use App\News;
use App\Source;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/', 'index', [
    'stories'  => Source::getSimilarNews(),
    'lastNews' => Source::getLastNews()->take(config('smi.news.renderCount')),
])->name('index');

Route::get('/news/{id}', function (string $id) {

    $story = Source::getSimilarNews()
        ->filter(static function (Collection $stories) use ($id) {
            return $stories->get('items')->filter(function (News $news) use ($id) {
                return $news->id === $id;
            })->isNotEmpty();
        })->first();

    $news = Source::getLastNews()
        ->filter(static function (News $news) use ($id) {
            return $news->id === $id;
        })->first();

    if ($news === null) {
        return redirect()->route('404');
    }

    if ($story !== null) {
        $story->put('main', $news);
    }

    return view('news', [
        'story'    => $story,
        'news'     => $news,
        'lastNews' => Source::getLastNews()->take(config('smi.news.renderCount')),
    ]);

})->name('news');

Route::feeds();

Route::view('/404', '404')
    ->name('404');
