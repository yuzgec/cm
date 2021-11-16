<?php

    Route::resource('/kullanici', 'KullaniciController')->middleware('auth');
    Route::get('/kullanici/switch', 'KullaniciController@active')->name('kullanici.switch');
