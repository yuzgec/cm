<?php

Route::middleware(['auth','role:Admin'])->prefix('kullanici')->group(function () {
    Route::resource('/kullanici', 'KullaniciController')->middleware(['auth', 'role:Admin']);
    Route::resource('/roller', 'RolController')->middleware(['auth', 'role:Admin']);

    Route::get('/mesai/giris-cikis', 'KullaniciController@giriscikis')->name('giriscikis');
    Route::get('/mesai/giris-cikis-detay/{id}', 'KullaniciController@giriscikisdetay')->name('giriscikisdetay');
    Route::get('/mesai/raporlama', 'KullaniciController@mesairaporlama')->name('mesairaporlama');

    Route::get('/mesai/ExcelIndir', 'KullaniciController@ExcelIndir');
    Route::get('/mesai/ExcelDetayIndir', 'KullaniciController@ExcelDetayIndir');
    Route::get('/mesai/MesaiRaporExcelIndir', 'KullaniciController@MesaiRaporExcelIndir')->name('mesairaporexcel');
    Route::resource('/mesai', 'MesaiController');
});
