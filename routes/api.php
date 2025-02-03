<?php

use App\Http\Controllers\RecipeController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/user/login', [UserController::class, 'login']);
Route::post('/user/create', [UserController::class, 'store']);
Route::post('/user/logout', [UserController::class, 'logout'])->middleware('auth:sanctum');

Route::resource('recipes', RecipeController::class)->middleware('auth:sanctum');