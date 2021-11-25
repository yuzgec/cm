<?php

Route::middleware(['auth'])->group(function () {

    Route::get('/mesai/giris-cikis', 'PersonelController@giriscikis')->name('giriscikis');
    Route::get('/mesai/giris-cikis-detay/{id}', 'PersonelController@giriscikisdetay')->name('giriscikisdetay');
    Route::get('/mesai/raporlama', 'PersonelController@mesairaporlama')->name('mesairaporlama');

    
    Route::resource('/personel', 'PersonelController');
    Route::resource('/mesai', 'MesaiController');

});