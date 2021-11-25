<?php

        Route::get('/smsgonder', 'SmsController@smsgonder')->name('smsgonder');
        Route::get('/toplusmsgonder', 'SmsController@toplusmsgonder')->name('toplusmsgonder');
        Route::get('/excelsmsgonder', 'SmsController@excelsmsgonder')->name('excelsmsgonder');
        Route::get('/smssablon', 'SmsController@smssablon')->name('smssablon');
        Route::get('/smsraporlama', 'SmsController@smsraporlama')->name('smsraporlama');

        Route::resource('/sms', 'SmsController');