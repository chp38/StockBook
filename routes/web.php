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

    // Home
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/', 'HomeController@index')->name('homePage');
    Route::post('/', 'HomeController@addPair')->name('homePost');

    // Trade types
    Route::resource('watchlist', 'TradeWatchlistController')->except([
        'edit', 'update', 'destroy'
    ]);

    Route::resource('trades', 'CurrentTradeController')->except([
        'edit', 'update', 'destroy'
    ]);

    Route::resource('history', 'TradeWatchlistController')->except([
        'edit', 'update', 'destroy'
    ]);

    // Currency Pairs - user can see
    Route::get('/currency/pairs', 'CurrencyPairsController@index')->name('currencyPairs.index');

    // logout
    Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

    // Manage Tokens
    Route::get('/manage/tokens', 'Api\ExpertAdvisorController@index')->name('manage-tokens');
    Route::post('/manage/tokens', 'Api\ExpertAdvisorController@store')->name('add-token');
    Route::POST('/manage/tokens/{id}', 'Api\ExpertAdvisorController@destroy')->name('delete-token');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/currency/pairs/{id}', 'CurrencyPairsController@show')->name('currencyPairs.show');
    //Routes for currency pairs admin page - add/remove/edit them
});