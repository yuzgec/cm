<?php


    Route::resource('/kullanici', 'KullaniciController')->middleware('auth');
    Route::resource('/roller', 'RolController')->middleware('auth');
