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
// 首页
Route::get('/', 'IndexController@index');

// 商品
Route::get('/prod', 'ProdController@index');
Route::get('/prod/categorys', 'ProdController@get_categorys');
Route::get('/prod/list', 'ProdController@get_prods');
Route::get('/prod/artists', 'ProdController@get_artists');
Route::get('/prod/detail', 'ProdController@get_detail');

// 艺人
Route::get('/artist', function () {
    return frontend_view('artist.list');
});
Route::get('/artist/list', 'ArtistController@list');
Route::get('/artist/{id}', 'ArtistController@detail')->name('artist_detail');

Route::get('/video', function () {
    return frontend_view('video.list');
});
Route::get('/video/list', 'VideoController@list');