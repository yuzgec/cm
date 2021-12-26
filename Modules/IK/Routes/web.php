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

Route::prefix('ik')->group(function() {
    Route::resource('/ik', 'IKController');
    Route::get('/calisanlar', 'IKController@calisanlar')->name('calisanlar');
    Route::get('/izinler', 'IKController@izinler')->name('izinler');
    Route::get('/harcamalar', 'IKController@index')->name('harcamalar');
    Route::get('/raporlar', 'IKController@index')->name('ikraporlar');
    Route::get('/takvim', 'IKController@index')->name('takvim');
});
