<?php

use Illuminate\Support\Facades\Route;

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

// Home route will redirect to orders list
Route::get('/', function () {
    return redirect(route('order.list'));
});

// Auh routes
Auth::routes();

// User Routes
Route::group(['prefix' => 'order'],function () {
    Route::get('/list', 'OrderController@list')->name('order.list');
    Route::get('/create', 'OrderController@create')->name('order.create');
    Route::post('/save', 'OrderController@save')->name('order.save');
    Route::get('/{order}/get', 'OrderController@get')->name('order.get');
    Route::get('/{order}/edit','OrderController@edit')->name('order.edit');
});

// Admin routes
Route::group(['prefix' => 'admin/order'],function () {
    Route::get('/list', 'AdminOrderController@list')->name('admin.order.list');
    Route::post('/{order}/update_status', 'AdminOrderController@updateStatus')->name('order.update_status');
});
