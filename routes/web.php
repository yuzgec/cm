<?php

use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Modules\Personel\Entities\Personel;
use Modules\Personel\Entities\PersonelBilgileri;
use Nwidart\Modules\Facades\Module;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Modules\Ayarlar\Entities\Departman;
use Illuminate\Support\Facades\DB;
Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::resource('roles', \App\Http\Controllers\RoleController::class)->middleware('auth');

Route::post('/OdemeSonuc', function (Request $request){

    $extra = explode('|',$request->TURKPOS_RETVAL_Ext_Data);

    $odeme = new \Modules\Odeme\Entities\Odeme;

    $odeme->islem_id             = $request->TURKPOS_RETVAL_Siparis_ID;
    $odeme->personel_id          = $extra[4];
    $odeme->dosya_no             = $extra[0];
    $odeme->tckn                 = $extra[1];
    $odeme->ad_soyad             = $extra[2];
    $odeme->kart_no              = $extra[3];
    $odeme->odeme_turu           = $extra[4];
    $odeme->dekont_id            = $request->TURKPOS_RETVAL_Dekont_ID;
    $odeme->islem_id             = $request->TURKPOS_RETVAL_Islem_ID;
    $odeme->odeme_tutari         = str_replace([","],["."],$request->TURKPOS_RETVAL_Odeme_Tutari);
    $odeme->odeme_komisyon       = str_replace([","],["."],$request->TURKPOS_RETVAL_Tahsilat_Tutari);

    if ($request->TURKPOS_RETVAL_Sonuc == 1) {
        $odeme->odeme_durumu         = $request->TURKPOS_RETVAL_Sonuc_Str;
    }else{
        $odeme->odeme_durumu           = $request->TURKPOS_RETVAL_Sonuc_Str;
        $odeme->odeme_hata_mesaji      = $request->TURKPOS_RETVAL_Sonuc_Str;
    }

    if ($request->TURKPOS_RETVAL_Sonuc == 1) {
        $odeme->odeme_cevap           = 1;
    }else{
        $odeme->odeme_cevap           = 0;
    }
//    dd($request->all());
    $odeme->save();

    if ($request->TURKPOS_RETVAL_Sonuc == 1){

        Mail::send("mail.odeme",compact('odeme'),function ($message){
            $message->to('orhan.ozcan@mecitkahraman.com.tr')->subject("Ödeme başarıyla oluşturmuştur.");
        });

//        Mail::send("mail.odeme",compact('odeme'),function ($message){
//            $message->to('olcayy@gmail.com')->subject("Ödeme başarıyla oluşturmuştur.");
//        });

    }else{
        dd($request->all());
        return "Hata <br />" . $request->TURKPOS_RETVAL_Sonuc_Str;
    }

    return "Ödeme işlemi başarıyla gerçekleşmiştir.";

});
Route::get('/Phone', function (){
    return view('phone');
});


Route::get('/Deneme', function (Request $request){

    $Baslangic = new Carbon\Carbon(\Carbon\Carbon::parse('2022-07-08 01:01:00'));
    $Bitis = new \Carbon\Carbon(\Carbon\Carbon::parse('2022-07-18 23:59:00'));

    $customDates = [];
    $Fark = $Baslangic->diffInDaysFiltered(function ($date){
        return !$date->isSunday() && !checkHoliday($date->format('Y-m-d'));
    }, $Bitis);
    dd($Fark);
});

function checkHoliday($date){
    $days = [];
    $Tatiller = \Modules\Ayarlar\Entities\Tatil::query()->whereYear("baslangic", \Carbon\Carbon::now()->year)->get();
    foreach ($Tatiller as $row){
        if($row->baslangic == $row->bitis){
            $days[] = $row->baslangic->format("Y-m-d");
        }else{
            $Periyod = \Carbon\CarbonPeriod::create($row->baslangic, '1 day', $row->bitis);
            foreach ($Periyod as $p){
                $days[] = $p->format('Y-m-d');
            }
        }
    }
    if(in_array($date, $days))
        return true;

    return false;
}
