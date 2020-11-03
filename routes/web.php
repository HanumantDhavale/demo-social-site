<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/", [
    "uses" => "HomeController@home",
    "as" => "site.home"
]);

Route::group(["middleware" => ["ss.guest"]], function () {
    Route::get("/login", [
        "uses" => "AuthController@login",
        "as" => "auth.login"
    ]);
    Route::post("/login", [
        "uses" => "AuthController@check",
        "as" => "auth.check"
    ]);
    Route::get("/register", [
        "uses" => "AuthController@register",
        "as" => "auth.register"
    ]);
    Route::post("/register", [
        "uses" => "AuthController@store",
        "as" => "auth.register.store"
    ]);

    Route::get("/forgot-password", [
        "uses" => "AuthController@forgotPassword",
        "as" => "auth.forgot.password"
    ]);
    Route::post("/forgot-password", [
        "uses" => "AuthController@resetLink",
        "as" => "auth.reset.link"
    ]);

    Route::get("/reset-password", [
        "uses" => "AuthController@resetPassword",
        "as" => "auth.reset.password"
    ]);
    Route::post("/reset-password", [
        "uses" => "AuthController@setNewPassword",
        "as" => "auth.set.password"
    ]);
});

Route::group(["middleware" => ["ss.auth"]], function () {
    Route::get('/profile', [
        "uses" => "AccountController@profile",
        "as" => "account.profile"
    ]);
    Route::post('/profile', [
        "uses" => "AccountController@updateProfile",
        "as" => "account.profile.update"
    ]);
    Route::get('/change-password', [
        "uses" => "AccountController@changePassword",
        "as" => "account.password"
    ]);
    Route::get('/followers', [
        "uses" => "AccountController@followers",
        "as" => "account.followers"
    ]);
    Route::get('/followings', [
        "uses" => "AccountController@followings",
        "as" => "account.followings"
    ]);
    Route::post('/change-password', [
        "uses" => "AccountController@updatePassword",
        "as" => "account.password.update"
    ]);
    Route::get("/logout", [
        "uses" => "AuthController@logout",
        "as" => "auth.logout"
    ]);

    Route::post('/post/store', [
        "uses" => "PostController@create",
        "as" => "post.create"
    ]);

    Route::post('/post/like', [
        "uses" => "PostController@doLike",
        "as" => "post.like"
    ]);

    Route::get('/follow/{user}', [
        "uses" => "AccountController@doFollow",
        "as" => "follow.user"
    ]);
    Route::get('/unfollow/{user}', [
        "uses" => "AccountController@doUnFollow",
        "as" => "unfollow.user"
    ]);
    Route::get('/my/posts', [
        "uses" => "AccountController@myPosts",
        "as" => "account.posts"
    ]);
    Route::post('/comment', [
        "uses" => "PostController@doComment",
        "as" => "post.comment"
    ]);
});

Route::post('/posts', [
    "uses" => "PostController@listPosts",
    "as" => "post.list"
]);

Route::get('/{user}/profile', [
    "uses" => "AccountController@userProfile",
    "as" => "user.profile"
]);

Route::get('/{user}/followers', [
    "uses" => "AccountController@userFollowers",
    "as" => "user.followers"
]);

Route::get('/{user}/followings', [
    "uses" => "AccountController@userFollowings",
    "as" => "user.followings"
]);

Route::get('/{user}/posts', [
    "uses" => "AccountController@userPosts",
    "as" => "user.posts"
]);

Route::post('/all/comments', [
    "uses" => "PostController@allComments",
    "as" => "all.comments"
]);
