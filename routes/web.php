<?php

use App\News;
use App\Source;
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
    'lastNews' => Source::getLastNews(),
])->name('index');

Route::get('/news/{id}', function (string $id) {

    $news = Source::getLastNews()
        ->filter(static function (News $news) use ($id) {
            return $news->id === $id;
        })->first();

    if ($news === null) {
        return redirect()->route('404');
    }

    return view('news', [
        'news' => $news,
    ]);

})->name('news');

Route::feeds();

Route::view('/404', '404')
    ->name('404');
