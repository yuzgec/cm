<?php

    Route::resource('/odeme', 'OdemeController')->middleware('auth');
    Route::post('/odemeal', 'OdemeController@odemeal')->name('odemeal')->middleware('auth');
    Route::match(['post', 'get'], '/odemesonuc', 'OdemeController@odemesonuc')->name('odemesonuc')->middleware('auth');
    Route::get('/odeme-basarili', 'OdemeControlle@success')->name('success')->middleware('auth');
    Route::get('/odeme-basarisiz', 'OdemeControlle@failed')->name('failed')->middleware('auth');