<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



Route::get('/', function () {
    return redirect()->route('product.paginate');
});

Route::get('/home', 'HomeController@index')->name('product.paginate');
Route::Auth();

Route::group(['prefix' => 'product', 'middleware' => 'authRole:admin'], function(){
    Route::get('/add', 'Admin\ProductController@create');
    Route::get('/', 'Admin\ProductController@index');
    Route::post('/add', 'Admin\ProductController@store');
    Route::get('/delete/{id}','Admin\ProductController@destroy');
    Route::get('/edit/{id}','Admin\ProductController@edit');
    Route::put('/edit/{id}','Admin\ProductController@update');
});

Route::group(['prefix' => 'cart', 'middleware' => 'authRole:member,admin'], function(){
    Route::get('/', 'Admin\CartController@index');
    Route::post('/add/{id}', 'Admin\CartController@store');
    Route::get('/delete/{id}','Admin\CartController@destroy');
});

Route::group(['prefix' => 'checkout', 'middleware' => 'authRole:member,admin'], function(){
    Route::post('/', 'Admin\CheckoutController@store');
});

Route::group(['prefix' => 'product', 'middleware' => 'authRole:member,admin'], function(){
    Route::get('/{slug}','Admin\ProductController@show');
    Route::post('/rate/{id}','Admin\ProductController@rate');
});

Route::group(['prefix' => 'user', 'middleware' => 'authRole:admin'], function(){
    Route::get('/add', 'Admin\UserController@create');
    Route::get('/', 'Admin\UserController@index');
    Route::post('/add', 'Admin\UserController@store');
    Route::get('/delete/{id}','Admin\UserController@destroy');
    Route::get('/edit/{id}','Admin\UserController@edit');
    Route::put('/edit/{id}','Admin\UserController@update');
});

Route::group(['prefix' => 'transaction', 'middleware' => 'authRole:admin'], function(){
    Route::get('/', 'Admin\TransactionController@index');
    Route::get('/delete/{id}','Admin\TransactionController@destroy');
});

Route::group(['middleware' => 'authRole:member'], function(){
    Route::get('/my-game', 'Member\MyController@index');
});


Route::group(['prefix' => 'genre', 'middleware' => 'authRole:admin'], function(){
    Route::get('/', 'Admin\GenreController@index');
    Route::get('/delete/{id}','Admin\GenreController@destroy');
    Route::get('/add','Admin\GenreController@create');
    Route::post('/add','Admin\GenreController@store');
    Route::get('/edit/{id}','Admin\GenreController@edit');
    Route::put('/edit/{id}','Admin\GenreController@update');
});

