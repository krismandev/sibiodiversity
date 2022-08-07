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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get("/login","AuthController@login")->name("login");

Route::post("/login","AuthController@postLogin")->name("postLogin");
Route::get("/logout","AuthController@logout")->name("logout");
Route::group(['middleware' => ['auth','cekstatus:0'],'prefix'=>'dashboard'], function(){
    Route::get('/', 'Dashboard\DashboardController@index')->name('home.dashboard');
});


Route::get('/class','Dashboard\ClassController@index')->name('class.index');
Route::get('/class/create','Dashboard\ClassController@create')->name('class.create');
Route::post('/class','Dashboard\ClassController@store')->name('class.store');
Route::get('/', 'FrontEnd\FrontEndController@index')->name('home.frontend');
Route::get('/explore', 'FrontEnd\FrontEndController@explore')->name('explore.frontend');

