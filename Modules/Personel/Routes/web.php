<?php

    Route::resource('/personel', 'PersonelController')->middleware('auth');
