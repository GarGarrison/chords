<?php

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
Route::get('/google08297e6daadffa99.html', function(){
    return File::get(public_path() . '/google08297e6daadffa99.html');
});
Route::get('/yandex_3a8bee90a3ca9a08.html', function(){
    return File::get(public_path() . '/yandex_3a8bee90a3ca9a08.html');
});
Route::get('/', 'MainController@index');
Route::get('/news', 'MainController@news');
Route::get('/popular', 'MainController@popular');
Route::get('/search', 'MainController@search');
// Route::get('/test', 'MainController@test');
Route::get('/artist/{artist}', 'MainController@artist');
Route::get('/letter/{letter}', 'MainController@letter');

Route::get('/ololo', 'AdminController@admin');

Route::get('/{song}', 'MainController@song');