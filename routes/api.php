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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('eas/auth', 'Api\ExpertAdvisorController@auth');

Route::apiResource('currency/pairs', 'Api\CurrencyPairsApiController')->except([
    'store', 'update', 'destroy'
]);

Route::get('currency/pairs/prices/{id}', 'Api\CurrencyPairsApiController@getPairPrices');