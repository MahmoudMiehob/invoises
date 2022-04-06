<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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



Route::group([
    'middleware' => 'api',
    'prefix' => 'auth',

], function ($router) {
    Route::post('/login', 'Api\AuthController@login');
    Route::post('/logout', 'Api\AuthController@logout');
    Route::post('/refresh', 'Api\AuthController@refresh');
    Route::get('/user-profile','Api\AuthController@userProfile');    
    });




    Route::middleware('jwt.verify')->group(function () {

        Route::get('/invoices','Api\InvoicesApi@index');
        Route::get('/invoice/{id}','Api\InvoicesApi@show');
        Route::post('/products','Api\InvoicesApi@store');
        Route::post('/products/{id}','Api\InvoicesApi@update');
        Route::post('/products_del/{id}','Api\InvoicesApi@destroy');

    });








