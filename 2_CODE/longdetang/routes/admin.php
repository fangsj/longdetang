<?php
/**
 * Created by PhpStorm.
 * User: fangsj
 * Date: 2017/10/27
 * Time: 下午4:45
 */
Route::get('login', 'LoginController@showLoginForm')->name('admin.login');
Route::post('login', 'LoginController@login');
Route::any('logout', 'LoginController@logout');
// 首页
Route::any('/', 'IndexController@welcome');
// 上传文件
Route::post('upload', 'UploadController@upload');
Route::post('uploadCK', 'UploadController@uploadCK');
// 商品分类
Route::get('prod/category', 'ProdCategoryController@list');
Route::post('prod/category/add', 'ProdCategoryController@add');
Route::any('prod/category/initEdit', 'ProdCategoryController@initEdit');
Route::post('prod/category/edit', 'ProdCategoryController@edit');
Route::post('prod/category/delete', 'ProdCategoryController@delete');
Route::post('prod/category/enable', 'ProdCategoryController@enable');
Route::post('prod/category/disable', 'ProdCategoryController@disable');
// 商品二级分类
Route::post('prod/category/second/add', 'ProdCategoryController@addSecondCategory');
Route::any('prod/category/second/initEdit', 'ProdCategoryController@initEditSecondCategory');
Route::post('prod/category/second/edit', 'ProdCategoryController@editSecondCategory');
Route::post('prod/category/second/delete', 'ProdCategoryController@deleteSecondCategory');
Route::post('prod/category/second/switch', 'ProdCategoryController@switchSecondCategory');
// 视频库管理
Route::get('video', 'VideoLibController@index');
Route::post('video', 'VideoLibController@query');
Route::post('video/delete', 'VideoLibController@delete');
Route::get('video/add', 'VideoLibController@initAdd');
Route::post('video/add', 'VideoLibController@add');
Route::get('video/edit', 'VideoLibController@initEdit');
Route::post('video/edit', 'VideoLibController@edit');
Route::post('video/status', 'VideoLibController@switchStatus');
// 艺人管理
Route::get('artist', 'ArtistController@index');
Route::post('artist', 'ArtistController@query');
Route::post('artist/delete', 'ArtistController@delete');
Route::get('artist/add', 'ArtistController@initAdd');
Route::post('artist/add', 'ArtistController@add');
Route::get('artist/edit', 'ArtistController@initEdit');
Route::post('artist/edit', 'ArtistController@edit');
Route::post('artist/search', 'ArtistController@search');
// 轮播管理
Route::get('banner', 'BannerController@index');
Route::post('banner', 'BannerController@query');
Route::post('banner/delete', 'BannerController@delete');
Route::get('banner/add', 'BannerController@initAdd');
Route::post('banner/add', 'BannerController@add');
Route::get('banner/edit', 'BannerController@initEdit');
Route::post('banner/edit', 'BannerController@edit');
// 商品管理
Route::get('prod', 'ProdController@index');
Route::post('prod', 'ProdController@query');
Route::get('prod/add', 'ProdController@initAdd');
Route::post('prod/add', 'ProdController@add');
Route::get('prod/edit', 'ProdController@initEdit');
Route::post('prod/edit', 'ProdController@edit');
Route::post('prod/delete', 'ProdController@delete');
Route::post('prod/status', 'ProdController@switchStatus');

// 新事管理
Route::get('article', 'ArticleController@index');
Route::post('article', 'ArticleController@query');
Route::post('article/delete', 'ArticleController@delete');
Route::get('article/add', 'ArticleController@initAdd');
Route::post('article/add', 'ArticleController@add');
Route::get('article/edit', 'ArticleController@initEdit');
Route::post('article/edit', 'ArticleController@edit');
Route::post('article/status', 'ArticleController@switchStatus');

//
Route::get('hotRecom', 'MidHotRecomController@index');
Route::post('hotRecom/save', 'MidHotRecomController@save');
