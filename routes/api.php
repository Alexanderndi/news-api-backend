<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\SourceController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\AuthorController;

Route::apiResource('articles', ArticleController::class);
Route::apiResource('sources', SourceController::class);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('authors', AuthorController::class);

// Custom endpoints for article search/filter
Route::get('articles/search', [ArticleController::class, 'search']);

use App\Http\Controllers\Api\UserPreferenceController;
Route::get('user-preferences/{user}', [UserPreferenceController::class, 'show']);
Route::put('user-preferences/{user}', [UserPreferenceController::class, 'update']);
