<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('/admin')->namespace("App\Http\Controllers\Admin")->name("admin")->group(function() {
    Route::name(".account.")->group(function() {
        $controller = "AccountController";
        Route::get("/login", "$controller@login")->name("login");
        Route::post("/login", "$controller@auth")->name("auth");
        Route::get("/logout", "$controller@logout")->name("logout");
    });
});

Route::prefix("/admin")->middleware('auth')->namespace("App\Http\Controllers\Admin")->name("admin")->group(function() {
    Route::name(".home.")->group(function() {
        $controller = "HomeController";
        Route::get("/", "$controller@index")->name("index");
    });
});


Route::get('/', function () {
    return view('welcome');
});
