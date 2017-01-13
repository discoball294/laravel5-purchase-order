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
Route::get('/get-token', function () {
    return Session::token();
});

Route::group(['prefix' => 'purchase'], function (){
    Route::post('/', 'PurchaseController@purchaseOrder')->name('purchase');
    Route::get('/{id}', [
        'uses' => 'PurchaseController@getPurchaseById',
        'as' => 'get-purchase'
    ]);
    Route::delete('/{id}', [
        'uses' => 'PurchaseController@deletePurchase',
        'as' => 'delete-purchase'
    ]);
    Route::get('/', [
        'uses' => 'PurchaseController@getPurchase',
        'as' => 'get-purchases'
    ]);
});