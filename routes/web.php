<?php

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
    'story' => Source::getSimilarNews(),
    'lastNews'  => Source::getLastNews(),
])->name('index');

Route::view('/news/{id}', 'news')
    ->name('news');

Route::feeds();

Route::view('/404', '404')
    ->name('404');
