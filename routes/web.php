<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/request', [HomeController::class , 'index'])->name('request');
Route::get('/get-services/{providerId}', [HomeController::class, 'getServices']);
