<?php

Route::group(['prefix' => 'sms'], function(){
        Route::get('/smsgonder', 'SmsController@smsgonder')->name('smsgonder');
        Route::get('/toplusmsgonder', 'SmsController@toplusmsgonder')->name('toplusmsgonder');
        Route::get('/excelsmsgonder', 'SmsController@excelsmsgonder')->name('excelsmsgonder');
        Route::get('/smsraporlama', 'SmsController@smsraporlama')->name('smsraporlama');

        Route::resource('/sms', SmsController::class);
        Route::resource('/smssablon', 'SmsSablonController');

    });

