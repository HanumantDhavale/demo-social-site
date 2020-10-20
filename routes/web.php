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

Route::get("/login", [
    "middleware" => ["ss.guest"],
    "uses" => "AuthController@login",
    "as" => "auth.login"
]);
Route::post("/login", [
    "middleware" => ["ss.guest"],
    "uses" => "AuthController@check",
    "as" => "auth.check"
]);

Route::get("/register", [
    "middleware" => ["ss.guest"],
    "uses" => "AuthController@register",
    "as" => "auth.register"
]);
Route::post("/register", [
    "middleware" => ["ss.guest"],
    "uses" => "AuthController@store",
    "as" => "auth.register.store"
]);
Route::get("/logout", [
    "uses" => "AuthController@logout",
    "as" => "auth.logout"
]);
