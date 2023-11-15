<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/get_all_post', "App\Http\Controllers\TestApiController@getAllPost");
    Route::get('/get_detail_post/{id}', "App\Http\Controllers\TestApiController@getDetailPost");
    Route::post('/comment', "App\Http\Controllers\TestApiController@comment");
    Route::get('/get_related_post/{id}', 'App\Http\Controllers\TestApiController@relatedPost');
    Route::get('/get_more_comment/{id}_{parentId}_{postId}', 'App\Http\Controllers\TestApiController@loadMoreComment');
});
