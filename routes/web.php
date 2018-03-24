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

Route::group(['prefix' => '/admin', 'as' => 'admin.'], function(){
  //User
  Route::get('/user', 'UserController@index')->name('user');
  Route::get('/user/create', 'UserController@create')->name('user.create');
  Route::post('/user', 'UserController@store')->name('user.store');
  Route::get('/user/{id}', 'UserController@show')->name('user.show');
  Route::put('/user/{id}', 'UserController@update')->name('user.update');
  Route::delete('/user/{id}', 'UserController@delete')->name('user.delete');

  //Category
  Route::get('/category', 'CategoryController@index')->name('category');
  Route::get('/category/create', 'CategoryController@create')->name('category.create');
  Route::post('/category', 'CategoryController@store')->name('category.store');
  Route::get('/category/{id}', 'CategoryController@show')->name('category.show');
  Route::put('/category/{id}', 'CategoryController@update')->name('category.update');
  Route::delete('/category/{id}', 'CategoryController@delete')->name('category.delete');

  //Product
  Route::get('/product', 'ProductController@index')->name('product');
  Route::get('/product/create', 'ProductController@create')->name('product.create');
  Route::post('/product', 'ProductController@store')->name('product.store');
  Route::get('/product/{id}', 'ProductController@show')->name('product.show');
  Route::put('/product/{id}', 'ProductController@update')->name('product.update');
  Route::delete('/product/{id}', 'ProductController@delete')->name('product.delete');
  


});
