<?php

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

Route::get('/logout', function () {
    Auth::logout();

    return redirect('/login');
});

Route::get('/registrasi', function () {
    return view('user_umum.registrasi');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/registrasi/save', 'RegistrasiController@store');
Route::post('/upload_dokumen_pendukung/save', 'RegistrasiController@upload');
Route::get('/success', 'RegistrasiController@check');
Route::get('/upload_dokumen_pendukung/{id}','RegistrasiController@halaman_upload');
Route::get('/detail_reg/{id}','RegistrasiController@detail');

Route::get('/data_reg_claim','AdminController@index');
Route::get('/approved/{id}','AdminController@approved');
Route::get('/nilai/{id}','AdminController@nilai');
Route::post('/storevalue','AdminController@storevalue');