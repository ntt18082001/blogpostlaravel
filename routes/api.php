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
    Route::get('/get_all_post', "App\Http\Controllers\Api\TestApiController@getAllPost");
    Route::get('/get_detail_post/{id}', "App\Http\Controllers\Api\TestApiController@getDetailPost");
    Route::post('/comment', "App\Http\Controllers\Api\TestApiController@comment");
    Route::get('/get_related_post/{id}', 'App\Http\Controllers\Api\TestApiController@relatedPost');
    Route::get('/get_more_comment/{id}_{parentId}_{postId}', 'App\Http\Controllers\Api\TestApiController@loadMoreComment');
    Route::get('/get_all_category', "App\Http\Controllers\Api\TestApiController@getCategories");
    Route::post('/save_post/{id?}', "App\Http\Controllers\Api\TestApiController@save");
    Route::get('/get_all_my_post', "App\Http\Controllers\Api\TestApiController@allMyPost");
    Route::get('/get_post_edit/{id}', "App\Http\Controllers\Api\TestApiController@getPostEdit");

    Route::prefix('/profile')->group(function() {
        Route::get('/count_my_post', '\App\Http\Controllers\Api\AccountController@countMyPost');
        Route::post('/update_info', '\App\Http\Controllers\Api\AccountController@updateUserInfo');
    });
});
