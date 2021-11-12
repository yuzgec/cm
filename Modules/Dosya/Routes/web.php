<?php

Route::resource('/dosya', 'DosyaController')->middleware('auth');
