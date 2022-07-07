<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::post('/register', 'UserController@register');
Route::post('/login', 'UserController@login');
Route::group(['middleware' => ['jwt.verify']], function ()
{
    Route::group(['middleware' => ['api.superadmin']], function ()
    {
        Route::delete('/customers/{id}', 'customersController@destroy');
        Route::delete('/produk/{id}', 'produkController@destroy');
        Route::delete('/order/{id}', 'orderController@destroy');
        Route::delete('/_detail_transaksi/{id}', '_detail_transaksiController@destroy');
    });  
    
    Route::group(['middleware' => ['api.admin']], function ()
    {
        Route::put('/customers/{id}', 'customersController@update');

        Route::post('/customers', 'customersController@store');
        Route::put('/produk/{id}', 'produkController@update');

        Route::post('/produk', 'produkController@store');
        Route::put('/order/{id}', 'orderController@update');

        Route::post('/order', 'orderController@store');
        Route::put('/_detail_transaksi/{id}', '_detail_transaksiController@update');

        Route::post('/_detail_transaksi', '_detail_transaksiController@store');

    });  
Route::get('/customers', 'customersController@show');
Route::get('/customers/{id}', 'customersController@detail');

Route::get('/produk', 'produkController@show');
Route::get('/produk/{id}', 'produkController@detail');

Route::get('/order', 'orderController@show');
Route::get('/order/{id}', 'orderController@detail');

Route::get('/_detail_transaksi', '_detail_transaksiController@show');
Route::get('/_detail_transaksi/{id}', '_detail_transaksiController@detail');

});

