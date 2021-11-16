<?php

    Route::resource('/kullanici', 'KullaniciController')->middleware(['role:Admin', 'auth']);
