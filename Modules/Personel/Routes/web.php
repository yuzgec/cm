<?php

Route::resource('/personel', 'PersonelController')->middleware('auth');
Route::resource('/mesai', 'MesaiController')->middleware('auth');
