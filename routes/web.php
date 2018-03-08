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

//customer
Route::get('/dashboard/customers', 'CustomerController@index')->name('customers')->middleware('auth.basic');
Route::get('/dashboard/customer/create', 'CustomerController@create')->name('customer.create')->middleware('auth.basic');
Route::post('/dashboard/customer/store', 'CustomerController@store')->name('customer.store')->middleware('auth.basic');
Route::get('/dashboard/customer/edit/{id}', 'CustomerController@edit')->name('customer.edit')->middleware('auth.basic');
Route::post('/dashboard/customer/update', 'CustomerController@update')->name('customer.update')->middleware('auth.basic');
Route::get('/dashboard/customer/destroy/{id}', 'CustomerController@destroy')->name('customer.destroy')->middleware('auth.basic');
//product
Route::get('/dashboard/products', 'ProductController@index')->name('products')->middleware('auth.basic');
Route::get('/dashboard/product/create', 'ProductController@create')->name('product.create')->middleware('auth.basic');
Route::post('/dashboard/product/store', 'ProductController@store')->name('product.store')->middleware('auth.basic');
Route::get('/dashboard/product/edit/{id}', 'ProductController@edit')->name('product.edit')->middleware('auth.basic');
Route::post('/dashboard/product/update', 'ProductController@update')->name('product.update')->middleware('auth.basic');
Route::get('/dashboard/product/destroy/{id}', 'ProductController@destroy')->name('product.destroy')->middleware('auth.basic');
