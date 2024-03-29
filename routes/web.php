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

Route::get('/getkabupaten', 'Dashboard\SpesiesController@getKabupaten');
Route::get('/getkecamatan', 'Dashboard\SpesiesController@getKecamatan');

Route::group(['middleware' => ['auth','cekstatus:0'],'prefix'=>'dashboard'], function(){
    Route::get('/', 'Dashboard\DashboardController@index')->name('home.dashboard');


    Route::group(['prefix'=>'verifikasi'], function(){
        Route::get('/','Dashboard\VerifikasiController@index')->name('verifikasi.index');
        Route::get('/detail/{id}','Dashboard\VerifikasiController@detail')->name('verifikasi.detail');
        Route::get('/spesies/{id}','Dashboard\VerifikasiController@update')->name('verifikasi.update');
        Route::get('/delete/{id}','Dashboard\VerifikasiController@delete')->name('verifikasi.delete');
    });


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
        Route::get('/gambar/delete/{nama_gambar}/{id}','Dashboard\SpesiesController@deleteGambar')->name('spesies.deleteGambar');
    });

    Route::group(['prefix'=>'gallery'], function(){
        Route::get('/','Dashboard\GalleryController@index')->name('gallery.index');
        Route::get('/create','Dashboard\GalleryController@create')->name('gallery.create');
        Route::post('/','Dashboard\GalleryController@store')->name('gallery.store');
        Route::get('/{id}','Dashboard\GalleryController@edit')->name('gallery.edit');
        Route::patch('/','Dashboard\GalleryController@update')->name('gallery.update');
        Route::get('/delete/{id}','Dashboard\GalleryController@delete')->name('gallery.delete');
    });

    Route::group(['prefix'=>'berita'], function(){
        Route::get('/','Dashboard\BeritaController@index')->name('berita.index');
        Route::get('/create','Dashboard\BeritaController@create')->name('berita.create');
        Route::post('/','Dashboard\BeritaController@store')->name('berita.store');
        Route::get('/{id}','Dashboard\BeritaController@edit')->name('berita.edit');
        Route::patch('/','Dashboard\BeritaController@update')->name('berita.update');
        Route::get('/delete/{id}','Dashboard\BeritaController@delete')->name('berita.delete');
    });

    Route::group(['prefix'=>'tentang'], function(){
        Route::get('/','Dashboard\TentangController@index')->name('tentang.index');
        Route::get('/create','Dashboard\TentangController@create')->name('tentang.create');
        Route::post('/','Dashboard\TentangController@store')->name('tentang.store');
        Route::patch('/','Dashboard\TentangController@update')->name('tentang.update');
    });

    Route::group(['prefix'=>'slider'], function(){
        Route::get('/','Dashboard\SliderController@index')->name('slider.index');
        Route::get('/create','Dashboard\SliderController@create')->name('slider.create');
        Route::post('/','Dashboard\SliderController@store')->name('slider.store');
        Route::get('/{id}','Dashboard\SliderController@edit')->name('slider.edit');
        Route::patch('/','Dashboard\SliderController@update')->name('slider.update');
        Route::get('/delete/{id}','Dashboard\SliderController@delete')->name('slider.delete');
    });

});

Route::group(['middleware' => ['auth','cekstatus:1']], function(){
    Route::group(['prefix'=>'member'], function(){
        Route::get('/explorer-index','FrontEnd\FrontEndController@explorerIndex')->name('member-explorer.index');
        Route::get('/explorer-create','FrontEnd\FrontEndController@explorercreate')->name('member-explorer.create');
        Route::post('/','FrontEnd\FrontEndController@explorerStore')->name('member-explorer.store');
        Route::get('/{id}','FrontEnd\FrontEndController@explorerEdit')->name('member-explorer.edit');
        Route::patch('/','FrontEnd\FrontEndController@explorerUpdate')->name('member-explorer.update');
        Route::get('/delete/{id}','FrontEnd\FrontEndController@explorerDelete')->name('member-explorer.delete');
        Route::get('/gambar/delete/{nama_gambar}/{id}','FrontEnd\FrontEndController@deleteGambar')->name('member-explorer.deleteGambar');
    });

});

Route::get('/', 'FrontEnd\FrontEndController@index')->name('home.frontend');
Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'FrontEnd\FrontEndController@switchLang']);
// Route::get('/change-to-english', 'FrontEnd\FrontEndController@changeBahasaEnglish')->name('change.english');
// Route::get('/change-to-indonesia', 'FrontEnd\FrontEndController@changeBahasaIndonesia')->name('change.indonesia');
Route::get('/explorer', 'FrontEnd\FrontEndController@explorer')->name('explorer.frontend');
Route::get('/explorer/filter', 'FrontEnd\FrontEndController@filterExplorer')->name('explorer.filter');
Route::get('/explorer-detail/{id}', 'FrontEnd\FrontEndController@explorerDetail')->name('explorer.detail');
Route::get('/gallery-sibiodiversity', 'FrontEnd\FrontEndController@gallery')->name('gallery.frontend');
Route::get('/berita-sibiodiversity', 'FrontEnd\FrontEndController@berita')->name('berita.frontend');
Route::get('/berita-detail/{id}', 'FrontEnd\FrontEndController@beritaDetail');
Route::get('/cari-berita', 'FrontEnd\FrontEndController@cariBerita');

Route::get('register','FrontEnd\FrontEndController@register')->name('register');
Route::post('register','FrontEnd\FrontEndController@storeRegister')->name('storeRegister');
