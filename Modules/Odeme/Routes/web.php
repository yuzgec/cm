<?php

use Illuminate\Support\Facades\Mail;

Route::post('/odeme/Oranlar', [\Modules\Odeme\Http\Controllers\OdemeController::class, "Oranlar"]);

Route::resource('/odeme', 'OdemeController')->middleware('auth');
    Route::post('/odemeal', 'OdemeController@odemeal')->name('odemeal')->middleware(['auth','role:İcra']);
    Route::match(['post', 'get'], '/odemesonuc', 'OdemeController@odemesonuc')->name('odemesonuc')->middleware(['auth','role:İcra']);
    Route::get('/odeme-basarili', 'OdemeController@success')->name('success');
    Route::get('/odeme-basarisiz', 'OdemeController@failed')->name('failed');

    Route::get('/mail', function (){
        $test = [1,2,3];

        Mail::send('mail.odeme', compact('test'),function ($message){
            $message->to('olcayy@gmail.com')->subject("Ödeme başarıyla oluşturmuştur.");
        });

    });
