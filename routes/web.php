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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get("/login","AuthController@login")->name("login");

Route::post("/login","AuthController@postLogin")->name("postLogin");
Route::get("/logout","AuthController@logout")->name("logout");

Route::get('/dashboard', 'Dashboard\DashboardController@home')->name('home');

Route::get('/class','Dashboard\ClassController@index')->name('class.index');
Route::get('/class/create','Dashboard\ClassController@create')->name('class.create');
Route::post('/class','Dashboard\ClassController@store')->name('class.store');
