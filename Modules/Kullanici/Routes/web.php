<?php


    Route::resource('/kullanici', 'KullaniciController')->middleware(['auth','role:Admin']);
    Route::resource('/roller', 'RolController')->middleware(['auth','role:Admin']);
