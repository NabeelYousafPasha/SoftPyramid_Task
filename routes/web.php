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

Route::group([
    'middleware' => 'auth',
], function() {
    Route::get('/users', 'UserController@index')->name('users');

    Route::get('/permission_role', 'UserController@list_permission_role')->name('permission_role');
    Route::post('/permission_role', 'UserController@store_permission_role')->name('permission_role');

    Route::get('/transactions', 'TransactionController@index')->name('transactions');
    Route::get('/transactions/list', 'TransactionController@list')->name('transactions.list');
    Route::get('/transactions/completedlist', 'TransactionController@completed_list')->name('transactions.completed.list');
    Route::get('/transactions/create', 'TransactionController@create')->name('transactions.create');
    Route::post('/transactions', 'TransactionController@store')->name('transactions.store');
    Route::get('/transactions/{transaction}', 'TransactionController@show')->name('transactions.show');
    Route::get('/transactions/{transaction}/edit', 'TransactionController@edit')->name('transactions.edit');
    Route::patch('/transactions/{transaction}', 'TransactionController@update')->name('transactions.update');
    Route::delete('/transactions/{transaction}', 'TransactionController@destroy')->name('transactions.delete');

    Route::get('/payments/{transaction}', 'PaymentController@index')->name('payments');
    Route::get('/payments/{transaction}/list', 'PaymentController@list')->name('payments.list');
    Route::get('/payments/{transaction}/create', 'PaymentController@create')->name('payments.create');
    Route::post('/payments/{transaction}', 'PaymentController@store')->name('payments.store');
    Route::get('/payments/{transaction}/{payment}', 'PaymentController@show')->name('payments.show');
    Route::get('/payments/{transaction}/{payment}/edit', 'PaymentController@edit')->name('payments.edit');
    Route::patch('/payments/{transaction}/{payment}', 'PaymentController@update')->name('payments.update');
    Route::delete('/payments/{transaction}/{payment}', 'PaymentController@destroy')->name('payments.delete');
});
