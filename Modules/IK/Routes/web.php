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
use Modules\IK\Http\Controllers\IKController;
Route::prefix('ik')->group(function() {
    Route::resource('/ik', 'IKController');
    Route::resource('/varyant', 'VaryantController');
    Route::resource('/izinkurallari', 'IzinKurallariController');
    Route::get('/calisanlar', 'IKController@calisanlar')->name('IK.calisanlar');
    Route::get('/calisanlar/Ekle', [IKController::class, 'create'])->name('IK.create');
    Route::post('/calisanlar/Ekle', [IKController::class, 'store'])->name('IK.store');
    Route::get('/calisanlar/{id}/Duzenle', [IKController::class, 'edit'])->name('IK.edit');
    Route::put('/calisanlar/{id}/Duzenle', [IKController::class, 'update'])->name('IK.update');

    Route::get('/izinler', 'IKController@izinler')->name('izinler');
    Route::get('/harcamalar', 'IKController@index')->name('harcamalar');
    Route::get('/raporlar', 'IKController@index')->name('ikraporlar');
    Route::get('/takvim', 'IKController@takvim')->name('takvim');

    Route::post('/IzinTalep', [IKController::class, 'IzinTalep'])->name('IK.izinTalep');
    Route::get('/IzinDetay/{id}', [IKController::class, 'IzinDetay'])->name('IK.izinDetay');
    Route::post('/IzinOnayla', [IKController::class, 'IzinOnayla'])->name('IK.izinOnayla');
    Route::post('/IzinReddet', [IKController::class, 'IzinReddet'])->name('IK.izinReddet');
});
