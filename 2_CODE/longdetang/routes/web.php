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
use App\User;
use App\Repositorys\UserRepository;
use App\Repositorys\Product\ProductRepository;

//Route::get('/', function (UserRepository $repository, ProductRepository $productRepository) {
//    return view('product.list');
//});

Route::group(['prefix' => 'admin','namespace' => 'Admin', 'middleware' => ['auth.admin:admin']],function ($router) {
    // 登录
    $router->get('login', 'LoginController@showLoginForm')->name('admin.login');
    $router->post('login', 'LoginController@login');
    $router->any('logout', 'LoginController@logout');
    // 首页
    $router->any('/', 'IndexController@welcome');
    // 上传文件
    $router->post('upload', 'UploadController@upload');
    // 商品分类
    $router->get('prod/category', 'ProdCategoryController@list');
    $router->post('prod/category/add', 'ProdCategoryController@add');
    $router->any('prod/category/initEdit', 'ProdCategoryController@initEdit');
    $router->post('prod/category/edit', 'ProdCategoryController@edit');
    $router->post('prod/category/delete', 'ProdCategoryController@delete');
    $router->post('prod/category/enable', 'ProdCategoryController@enable');
    $router->post('prod/category/disable', 'ProdCategoryController@disable');
    // 商品二级分类
    $router->post('prod/category/second/add', 'ProdCategoryController@addSecondCategory');
    $router->any('prod/category/second/initEdit', 'ProdCategoryController@initEditSecondCategory');
    $router->post('prod/category/second/edit', 'ProdCategoryController@editSecondCategory');
    $router->post('prod/category/second/delete', 'ProdCategoryController@deleteSecondCategory');
    $router->post('prod/category/second/switch', 'ProdCategoryController@switchSecondCategory');
    // 视频库管理
    $router->get('video', 'VideoLibController@index');
    $router->post('video', 'VideoLibController@query');
    $router->post('video/delete', 'VideoLibController@delete');
    $router->get('video/add', 'VideoLibController@initAdd');
    $router->post('video/add', 'VideoLibController@add');
    $router->get('video/edit', 'VideoLibController@initEdit');
    $router->post('video/edit', 'VideoLibController@edit');
    $router->post('video/status', 'VideoLibController@switchStatus');
    // 艺人管理
    $router->get('artist', 'ArtistController@index');
    $router->post('artist', 'ArtistController@query');
    $router->post('artist/delete', 'ArtistController@delete');
    $router->get('artist/add', 'ArtistController@initAdd');
    $router->post('artist/add', 'ArtistController@add');
    $router->get('artist/edit', 'ArtistController@initEdit');
    $router->post('artist/edit', 'ArtistController@edit');
});

//Auth::routes();
//
//Route::get('/home', 'HomeController@index')->name('home');
