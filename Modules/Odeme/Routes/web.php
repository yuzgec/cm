<?php

use Illuminate\Support\Facades\Mail;

Route::resource('/odeme', 'OdemeController')->middleware('auth');
    Route::post('/odemeal', 'OdemeController@odemeal')->name('odemeal')->middleware(['auth','role:Admin']);
    Route::match(['post', 'get'], '/odemesonuc', 'OdemeController@odemesonuc')->name('odemesonuc')->middleware(['auth','role:Admin']);
    Route::get('/odeme-basarili', 'OdemeController@success')->name('success');
    Route::get('/odeme-basarisiz', 'OdemeController@failed')->name('failed');


    Route::get('/mail', function (){
        $test = [1,2,3];

        Mail::send('mail.odeme', compact('test'),function ($message){
            $message->to('olcayy@gmail.com')->subject("Ödeme başarıyla oluşturmuştur.");
        });

    });
