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

Route::get('/home', 'HomeController@index')->name('home');

// PRODUCT FUNCTIONS
Route::get('/cart/{id}', 'ProductsController@showCart');
Route::post('/home/add', 'ProductsController@addToCart');
Route::post('/cart/update', 'ProductsController@updateQuantity');
Route::post('/cart/delete', 'ProductsController@deleteItem');