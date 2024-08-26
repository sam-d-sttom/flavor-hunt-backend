<?php

use App\Http\Controllers\RecipeController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::post('/user', [UserController::class,'createUser']);

Route::get('/getAllRecipes', [RecipeController::class,'getAllRecipes']);
Route::get('/getRecipesByTag', [RecipeController::class,'getRecipesByTag']);
Route::get('/getLatestRecipes', [RecipeController::class,'getLatestRecipes']);
Route::get('/getRecipesBasedOnSearchParams', [RecipeController::class,'getRecipesBasedOnSearchParams']);
