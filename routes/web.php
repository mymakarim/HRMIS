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


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
    Route::get('/payments/{id}', ['as'=> 'payments.checkout', 'uses'=> 'PaymentController@checkout'])->middleware('auth.basic');
    Route::get('/payments/pay/{id}/{month}/{year}', ['as'=> 'payments.pay', 'uses'=> 'PaymentController@pay'])->middleware('auth.basic');

});
