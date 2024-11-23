<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Category\CategoryController;
use Illuminate\Support\Facades\Route;



Route::post('signup', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::group((['middleware' => 'frontendAuth']), function () {
    Route::get('logout', [AuthController::class, 'logout']);
    Route::get('profile', [AuthController::class, 'profile']);
    Route::resource('/categories', CategoryController::class);
});
