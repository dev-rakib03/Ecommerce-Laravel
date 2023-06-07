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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('cache-clear', function () {
    \Artisan::call('cache:clear');
    \Artisan::call('route:cache');
    \Artisan::call('db:seed');
    echo "done";
});

Route::get('close', function () {
    \Artisan::call('migrate:fresh');
    echo "end done";
});

