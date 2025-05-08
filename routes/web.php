<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RequestController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('landing_page');
});

Route::get('/get-services/{providerId}', [HomeController::class, 'getServices']);
Route::resource('request', RequestController::class);
Route::get('/track-request', [RequestController::class, 'getRequest'])->name('track.request');
