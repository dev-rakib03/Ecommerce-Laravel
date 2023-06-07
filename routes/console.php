<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

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
