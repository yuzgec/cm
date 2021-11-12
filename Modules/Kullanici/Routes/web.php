<?php

    Route::resource('/kullanici', 'KullaniciController')->middleware('auth');
