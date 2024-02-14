<?php

use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'v1'], function(Router $router) {
    $router->group(['prefix' => 'urls'], function(Router $router) {
        $router->post('upload', \App\Http\Controllers\UrlShortenerController::class . '@upload');

    });
    $router->group(['prefix' => 'short-codes'], function(Router $router) {
        $router->get('recent', \App\Http\Controllers\UrlShortenerController::class . '@listRecent');
        $router->get('{shortCodeId}', \App\Http\Controllers\UrlShortenerController::class . '@details')->name('short_code_details');
    });
});
