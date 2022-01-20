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

Route::prefix('profil')->group(function() {
    Route::get('/', 'ProfilController@index');
    Route::get('/Duzenle', [\Modules\Profil\Http\Controllers\ProfilController::class, 'edit'])->name('profil.duzenle');
    Route::put('/Duzenle', [\Modules\Profil\Http\Controllers\ProfilController::class, 'update'])->name('profil.guncelle');
    Route::get('Mesailerim', [\Modules\Profil\Http\Controllers\ProfilController::class, 'mesailerim'])->name('profil.mesailerim');
});
