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

Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/', 'HomeController@index')->name('home');

    Route::resource('watchlist', 'TradeWatchlistController');

    Route::get('/currency/pairs', 'CurrencyPairsController@index')->name('currencyPairs.index');
    Route::get('/currency/pairs/{id}', 'CurrencyPairsController@index')->name('currencyPairs.show');

    Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

});
