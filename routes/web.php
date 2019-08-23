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
Route::get('/', function () {
    // return view('welcome');
    // print_r(app()->make('redis')); // predis in laravel check
    /**
     * Make redis keys, example simple
     */
    // $redis = app()->make('redis'); // call library radis
    // $redis->set('key','value'); // make key and value to function set()
    // return $redis->get('key'); // see key with function get()

    // $app = Illuminate\Support\Facades\Redis::connection();
    // $app->set('key2','value2');
    // print_r($app->get('key2')); // Test 2 for redis make
});

/**
 * Make redis in controller
 */
Route::get('/', 'WelcomeController@index');

Route::get('/article/{id}', 'PostController@showArticle')->where('id','[0-9]+');

Auth::routes();

Route::group(['middleware'=>'auth'],function(){
    Route::get('/home', 'HomeController@index')->name('home')->middleware('adminRole');
    Route::get('/admin', 'HomeController@admin')->name('admin')->middleware('adminRole');
});

/**
 * Product Route
 */
Route::get('/data-product', 'Product\ProductController@getAllProducts');
Route::post('/product/add', 'Product\ProductController@createProducts');
Route::get('/product/show/{id}', 'Product\ProductController@getProducts');
Route::patch('/product/update', 'Product\ProductController@updateProducts');
Route::delete('/product/delete/{id}', 'Product\ProductController@deleteProducts');

/**
 * Cart Route 
 */
Route::get('/cart', 'Cart\CartController@Cart');
Route::put('/add-cart/{id}', 'Cart\CartController@addToCart');
Route::patch('update-cart', 'Cart\CartController@updateCart');
Route::delete('delete-cart', 'Cart\CartController@deleteCart');
/**
 * Import Route 
 */
Route::get('/product/export_excel','Product\ProductController@export_excel');
Route::post('/product/import_excel','Product\ProductController@import_excel');
Route::get('/product/pdf','Product\ProductController@pdf');

/**
 * Category Route
 */
Route::get('/data-category', 'Product\CategoriesController@getAllCategory');
Route::post('/category/add', 'Product\CategoriesController@createCategory');
Route::get('/category/show/{id}', 'Product\CategoriesController@getCategory');
Route::put('/category/update', 'Product\CategoriesController@updateCategory');
Route::delete('/category/delete/{id}', 'Product\CategoriesController@deleteCategory');

// Route::post('/cart/add', 'Cart\CartController@addCart');

/**
 * Route Blog
 */
Route::resource('blog', 'BlogController'); 
