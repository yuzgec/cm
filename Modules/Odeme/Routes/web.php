<?php

    Route::resource('/odeme', 'OdemeController')->middleware('auth');
    Route::post('/odemeal', 'OdemeController@odemeal')->name('odemeal');
    Route::match(['post', 'get'], '/odemesonuc', 'OdemeController@odemesonuc')->name('odemesonuc');
    Route::get('/odeme-basarili', 'OdemeController@success')->name('success');
    Route::get('/odeme-basarisiz', 'OdemeController@failed')->name('failed');
