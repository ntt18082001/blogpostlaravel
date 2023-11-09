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

Route::prefix('/')->namespace("App\Http\Controllers\Admin")->name("account.")->group(function () {
    $controller = "AccountController";
    Route::get("/login", "$controller@login")->name("login");
    Route::post("/login", "$controller@auth")->name("auth");
    Route::get("/logout", "$controller@logout")->name("logout");
    Route::get('/register', "$controller@register")->name('register');
    Route::post('/register', "$controller@register_post")->name('register_post');
});

Route::prefix("/admin")->middleware('admin')->namespace("App\Http\Controllers\Admin")->name("admin")->group(function () {
    Route::name(".home.")->group(function () {
        $controller = "HomeController";
        Route::get("/", "$controller@index")->name("index");
    });

    Route::prefix('/user')->name(".user.")->group(function () {
        $controller = "UserController";
        Route::get("/create", "$controller@create")->name("create");
        Route::post("/save/{id?}", "$controller@save")->name("save");
        Route::get("/index", "$controller@index")->name("index");
        Route::get('/delete/{id}', "$controller@delete")->name("delete");
        Route::get('/edit/{id}', "$controller@edit")->name('edit');
    });

    Route::prefix('/category')->name('.category.')->group(function () {
        $controller = "CategoryController";
        Route::get('/index', "$controller@index")->name('index');
        Route::get("/create", "$controller@create")->name("create");
        Route::post("/save/{id?}", "$controller@save")->name("save");
        Route::get('/delete/{id}', "$controller@delete")->name("delete");
        Route::get('/edit/{id}', "$controller@edit")->name('edit');
    });

    Route::prefix('/post')->name('.post.')->group(function () {
        $controller = "PostController";
        Route::get('/index', "$controller@index")->name('index');
        Route::get("/create", "$controller@create")->name("create");
        Route::post("/save/{id?}", "$controller@save")->name("save");
        Route::get('/delete/{id}', "$controller@delete")->name("delete");
        Route::get('/edit/{id}', "$controller@edit")->name('edit');
        Route::get('/detail/{id}', "$controller@detail")->name('detail');
        Route::get('/publish/{id}', "$controller@publish")->name('publish');
    });
});

Route::get('/', "App\Http\Controllers\Client\HomeController@index")->name('index');

Route::get('/post-{id}', "App\Http\Controllers\Client\PostController@detail")->name('client.post.detail');

Route::get('/category-{id}', "App\Http\Controllers\Client\CategoryController@index")->name('client.category.index');

Route::prefix('/profile')->name('profile.')->middleware('auth')->namespace("App\Http\Controllers\Client")->group(function () {
    $controller = "ProfileController";
    Route::get('/index', "$controller@index")->name('index');
    Route::post('/save/{id?}', "$controller@save")->name('save');
    Route::get('/create_post', "PostController@create")->name('create-post');
    Route::post('/save_post/{id?}', "PostController@save")->name('savepost');
    Route::get('/all_post', "PostController@allPost")->name('all_post');
    Route::post('/comment', "PostController@comment")->name('comment');
    Route::get('/edit/{id}', "PostController@edit")->name('editpost');
});
