<?php

use App\Http\Controllers\RecipeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/getAllRecipes', [RecipeController::class,'getAllRecipes']);
Route::get('/getRecipesByTag', [RecipeController::class,'getRecipesByTag']);
Route::get('/getLatestRecipes', [RecipeController::class,'getLatestRecipes']);
Route::get('/getLatestRecipesByCountry', [RecipeController::class,'getLatestRecipesByCountry']);
