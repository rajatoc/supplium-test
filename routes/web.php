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
//Route::resource('company', 'CompanyController');
Route::get('company', 'Api\CompanyController@index');
Route::post('company', 'Api\CompanyController@store');
Route::get('company/{id}', 'Api\CompanyController@show');
Route::get('company/{id}/products', 'Api\CompanyController@products');
Route::post('company/{id}/products', 'Api\CompanyController@assignProduct');
Route::get('company/{id}/users', 'Api\CompanyController@users');
Route::put('company/{id}', 'Api\CompanyController@update');

Route::get('products', 'Api\ProductController@index');
Route::post('products', 'Api\ProductController@store');
Route::get('products/{id}', 'Api\ProductController@show');
Route::get('products/{id}/categories', 'Api\ProductController@categories');
Route::post('products/{id}/categories', 'Api\ProductController@assignCategories');


Route::get('orders', 'Api\OrderController@index');
Route::post('companies/{id}/orders', 'Api\OrderController@store');
Route::get('orders/{id}', 'Api\OrderController@show');



Route::get('categories', 'Api\CategoryController@index');
Route::post('categories', 'Api\CategoryController@store');
Route::get('categories/{id}', 'Api\CategoryController@show');