<?php

Route::middleware(['auth','role:Admin'])->prefix('personel')->group(function () {

    Route::get('/mesai/giris-cikis', 'PersonelController@giriscikis')->name('giriscikis');
    Route::get('/mesai/giris-cikis-detay/{id}', 'PersonelController@giriscikisdetay')->name('giriscikisdetay');
    Route::get('/mesai/raporlama', 'PersonelController@mesairaporlama')->name('mesairaporlama');


    Route::get('/mesai/ExcelIndir', 'PersonelController@ExcelIndir');
    Route::get('/mesai/ExcelDetayIndir', 'PersonelController@ExcelDetayIndir');
    Route::get('/mesai/MesaiRaporExcelIndir', 'PersonelController@MesaiRaporExcelIndir')->name('mesairaporexcel');

    Route::resource('/personel', 'PersonelController');
    Route::resource('/mesai', 'MesaiController');



});
