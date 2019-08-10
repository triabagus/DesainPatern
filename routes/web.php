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
    return view('welcome');
});

Auth::routes();

Route::group(['middleware'=>'auth'],function(){
    Route::get('/home', 'HomeController@index')->name('home');
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


