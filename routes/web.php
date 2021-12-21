<?php

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Nwidart\Modules\Facades\Module;
use Spatie\Permission\Models\Permission;


Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::resource('roles', \App\Http\Controllers\RoleController::class)->middleware('auth');

Route::get('rollers', function (){

   foreach (Module::scan() as $m){
       Permission::create(['name' => $m. ' Listele']);
       Permission::create(['name' => $m. ' Ekle']);
       Permission::create(['name' => $m. ' Düzenle']);
       Permission::create(['name' => $m. ' Sil']);
   }
});

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

        $mail = \Modules\Odeme\Entities\Odeme::with('getPersonel')->find($odeme->id);
        dd($mail);

        Mail::send("mail.odeme",compact('mail'),function ($message){
            $message->to('salih.arik@mecitkahraman.com.tr')->subject("Ödeme başarıyla oluşturmuştur.");
        });

        Mail::send("mail.odeme",compact('mail'),function ($message){
            $message->to('olcayy@gmail.com')->subject("Ödeme başarıyla oluşturmuştur.");
        });

        return "Ödeme işlemi başarıyla gerçekleşmiştir.";
    }else{
        dd($request->all());
        return "Hata <br />" . $request->TURKPOS_RETVAL_Sonuc_Str;
    }
});
