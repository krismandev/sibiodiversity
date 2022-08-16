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

    Route::group(['prefix'=>'class'], function(){
        Route::get('/','Dashboard\ClassController@index')->name('class.index');
        Route::get('/create','Dashboard\ClassController@create')->name('class.create');
        Route::post('/','Dashboard\ClassController@store')->name('class.store');
        Route::get('/{id}','Dashboard\ClassController@edit')->name('class.edit');
        Route::patch('/','Dashboard\ClassController@update')->name('class.update');
        Route::get('/delete/{id}','Dashboard\ClassController@delete')->name('class.delete');
    });

    Route::group(['prefix'=>'ordo'], function(){
        Route::get('/','Dashboard\OrdoController@index')->name('ordo.index');
        Route::get('/create','Dashboard\OrdoController@create')->name('ordo.create');
        Route::post('/','Dashboard\OrdoController@store')->name('ordo.store');
        Route::get('/{id}','Dashboard\OrdoController@edit')->name('ordo.edit');
        Route::patch('/','Dashboard\OrdoController@update')->name('ordo.update');
        Route::get('/delete/{id}','Dashboard\OrdoController@delete')->name('ordo.delete');
    });

    Route::group(['prefix'=>'famili'], function(){
        Route::get('/','Dashboard\FamiliController@index')->name('famili.index');
        Route::get('/create','Dashboard\FamiliController@create')->name('famili.create');
        Route::post('/','Dashboard\FamiliController@store')->name('famili.store');
        Route::get('/{id}','Dashboard\FamiliController@edit')->name('famili.edit');
        Route::patch('/','Dashboard\FamiliController@update')->name('famili.update');
        Route::get('/delete/{id}','Dashboard\FamiliController@delete')->name('famili.delete');
    });

    Route::group(['prefix'=>'genus'], function(){
        Route::get('/','Dashboard\GenusController@index')->name('genus.index');
        Route::get('/create','Dashboard\GenusController@create')->name('genus.create');
        Route::post('/','Dashboard\GenusController@store')->name('genus.store');
        Route::get('/{id}','Dashboard\GenusController@edit')->name('genus.edit');
        Route::patch('/','Dashboard\GenusController@update')->name('genus.update');
        Route::get('/delete/{id}','Dashboard\GenusController@delete')->name('genus.delete');
    });

    Route::group(['prefix'=>'spesies'], function(){
        Route::get('/','Dashboard\SpesiesController@index')->name('spesies.index');
        Route::get('/create','Dashboard\SpesiesController@create')->name('spesies.create');
        Route::post('/','Dashboard\SpesiesController@store')->name('spesies.store');
        Route::get('/{id}','Dashboard\SpesiesController@edit')->name('spesies.edit');
        Route::patch('/','Dashboard\SpesiesController@update')->name('spesies.update');
        Route::get('/delete/{id}','Dashboard\SpesiesController@delete')->name('spesies.delete');
    });
});
Route::get('/', 'FrontEnd\FrontEndController@index')->name('home.frontend');
Route::get('/explore', 'FrontEnd\FrontEndController@explore')->name('explore.frontend');

