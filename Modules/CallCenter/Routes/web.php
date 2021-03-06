<?php
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('callcenter')->group(function() {
    Route::middleware(['auth'])->group(function (){
        Route::resource('/callcenter', 'CallCenterController');
        Route::get('dosyaexcelyukle', 'DosyaController@excelyukle')->name('dosyaexcelyukle');
        Route::post('dosyaexcelyukle', 'DosyaController@exceloku')->name('callcenter.dosya.exceloku');
        Route::post('dosyaexcelisle', 'DosyaController@excelisle')->name('callcenter.dosya.excelisle');
        Route::resource('/grup', 'GrupController');
        Route::post('/dosya/GorusmeKaydet/{dosyaId}', 'DosyaController@gorusmeKaydet')->name('callcenter.dosya.gorusmekaydet');
        Route::resource('/dosya', 'DosyaController');

        Route::get('bedenihasarexcelyukle', 'BedeniHasarController@excelyukle')->name('bedenihasarexcelyukle');
        Route::post('bedenihasarexcelyukle', 'BedeniHasarController@exceloku')->name('callcenter.bedenihasar.exceloku');
        Route::post('bedenihasarexcelisle', 'BedeniHasarController@excelisle')->name('callcenter.bedenihasar.excelisle');
        Route::resource('/bedenihasar', 'BedeniHasarController');
        Route::resource('/alacakli', 'AlacakliController');
        Route::resource('/borclu', 'BorcluController');
        Route::get('toplu-takip-acilislari', 'CallCenterController@topluTakipAcilis')->name('callcenter.toplu-takip-acilislari');
        Route::get('takdiyat-raporlari', 'CallCenterController@takdiyatRaporlari')->name('callcenter.takdiyat-raporlari');
        Route::get('mts-toplu-takip-islemleri', 'CallCenterController@mtsTopluTakipIslemleri')->name('callcenter.mts-toplu-takip-islemleri');
        Route::get('uyap-mernis-sorgulama', 'CallCenterController@uyapMernisSorgulama')->name('callcenter.uyap-mernis-sorgulama');
        Route::get('uyap-sgk-sorgulama', 'CallCenterController@uyapSgkSorgulama')->name('callcenter.uyap-sgk-sorgulama');
        Route::get('lisans-modulu', 'CallCenterController@lisansModulu')->name('callcenter.lisans-modulu');
    });

});
