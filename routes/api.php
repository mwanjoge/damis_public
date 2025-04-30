<?php

use App\Http\Controllers\CountryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('embassy', [App\Http\Controllers\EmbassyController::class,'store']);
Route::resource('country', CountryController::class)->names('country');