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
    Route::get('/takvim', 'IKController@takvim')->name('takvim');

    Route::post('/IzinTalep', [IKController::class, 'IzinTalep'])->name('IK.izinTalep');
    Route::get('/IzinDetay/{id}', [IKController::class, 'IzinDetay'])->name('IK.izinDetay');
    Route::post('/IzinOnayla', [IKController::class, 'IzinOnayla'])->name('IK.izinOnayla');
    Route::post('/IzinReddet', [IKController::class, 'IzinReddet'])->name('IK.izinReddet');

    Route::post('/AvansTalep', [IKController::class, 'AvansTalep'])->name('IK.avansTalep');
    Route::get('/AvansDetay/{id}', [IKController::class, 'AvansDetay'])->name('IK.avansDetay');
    Route::post('/AvansOnayla', [IKController::class, 'AvansOnayla'])->name('IK.avansOnayla');
    Route::post('/AvansReddet', [IKController::class, 'AvansReddet'])->name('IK.avansReddet');

    Route::get('/raporlar/mesai/tariharaligi', [IKController::class, 'MesaiTarihAralihi'])->name('IK.raporlar.mesaitariharaligi');
    Route::get('/raporlar', [IKController::class, 'Raporlar'])->name('IK.raporlar');
    Route::get('/Mail', function (){
        $izin = \Modules\IK\Entities\Izin::query()->first();

        dump();
        dd('');
        return view('ik::emails.izintalep', compact('izin'));
    });

    Route::get('/IzinTalepEt', [IKController::class, 'IzinTalepEt'])->name('IK.izinTalepEt');
    Route::get('/IzinEkle/{id}', [IKController::class, 'IzinEkle'])->name('IK.izinEkle');
    Route::post('/IzinOlustur', [IKController::class, 'IzinOlustur'])->name('IK.izinOlustur');
    Route::get('/IzinTalepFormu/{id}', [IKController::class, 'IzinTalepFormu'])->name('IK.IzinTalepFormu');
    Route::get('/IzinMutabakat', [IKController::class, 'IzinMutabakat'])->name('IK.IzinMUtakabat');
    Route::get('/IzinHesapla', [IKController::class, 'IzinHesapla'])->name('IK.IzinHesapla');
    Route::delete('/IzinSil/{id}', [IKController::class, 'IzinSil'])->name('IK.IzinSil');
    Route::get('/OzlukIndir', [IKController::class, 'OzlukIndir'])->name('IK.OzlukIndir');
});
