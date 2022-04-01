<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Request;
use Modules\Personel\Entities\Personel;

function menu_is_active($url, $durum = 'active')
{
    return (Request::segment(1) == $url) ? $durum : null;
}

function ikmasonary($url){
    return (Request::segment(1) == $url) ? 'true' : null;
}

function isim($isim){
    $parcala = explode(" ", $isim);
    $ilk = mb_substr(current($parcala), 0,1);
    $son = mb_substr(end($parcala), 0,1);
    return mb_convert_encoding($ilk.' '.$son, "UTF-8", "ISO-8859-9");
}

function money($deger){
    return number_format((float)$deger, 2, ',', '');
}
function PuantajGetir($Personel, $Tarih, $MesaiBaslangic, $MesaiBitis){
//    $Personel = Personel::findOrFail($UserId);
//    $MesaiBaslangic = $Personel->mesai->mesai_giris;
//    $MesaiBitis = $Personel->mesai->mesai_cikis;
    if(Carbon::parse($Tarih)->isFriday())
        $MesaiBitis = "17:00:00";

    $Kontrol = \Modules\Personel\Entities\Puantaj::where('user_id', $Personel->id)->where('gun', $Tarih);
    if($Kontrol->count()>0){
        return $Kontrol->first();
    }
    $BaslangicSaati = Carbon::parse($Tarih . " " . $MesaiBaslangic)->format('Y-m-d H:i:s');
    $BitisSaati = Carbon::parse($Tarih . " " . $MesaiBitis)->format('Y-m-d H:i:s');
    $IlkGiris =$Personel->Monitoring()->whereDate('Eventtime', $Tarih)->where('TerminalID',3)->orderBy('Eventtime','ASC');
    if($IlkGiris->count() < 1)
        return false;
    $IlkGiris = $IlkGiris->first();
    $GirisFark = Carbon::parse($BaslangicSaati)->diffInMinutes($IlkGiris->Eventtime, false);
    $SonCikis = $Personel->Monitoring()->whereDate('Eventtime', $Tarih)->where('TerminalID', 1)->orderBy('Eventtime','DESC')->first();
    if(!$SonCikis){
        return false;
    }
    $CikisFark = Carbon::parse($BitisSaati)->diffInMinutes($SonCikis->Eventtime, false);
    if($GirisFark>0)
        $GirisFark = 0;
    if($CikisFark<0)
        $CikisFark = 0;
    $Kayit = new \Modules\Personel\Entities\Puantaj();
    $Kayit->user_id = $Personel->id;
    $Kayit->gun = $Tarih;
    $Kayit->calisma_gun = 1;
    $Kayit->fazla_calisma = $CikisFark;
    $Kayit->gec_mesai = $GirisFark;
    $Kayit->mesai_giris = $IlkGiris->Eventtime;
    $Kayit->mesai_cikis = $SonCikis->Eventtime;
    $Kayit->save();
    return $Kayit;
}
function getGorusmeSonuc($id){
    $sonucListe = [
        ["id" => "0", "name" => "Cevapsız"],
        ["id" => "1", "name" => "Yarıda Kesildi"],
        ["id" => "2", "name" => "Müsait Değil"],
        ["id" => "3", "name" => "Yanlış Arama"],
        ["id" => "4", "name" => "Meşgul"],
        ["id" => "5", "name" => "Kapalı"],
        ["id" => "7", "name" => "Uygunsuz Arama"],
        ["id" => "8", "name" => "Şikayet"],
        ["id" => "9", "name" => "Genel Bilgi"],
        ["id" => "10", "name" => "Müşteriyi Geç"],
        ["id" => "11", "name" => "Numara Kullanılmıyor"],
        ["id" => "12", "name" => "Numara Yok"],
        ["id" => "13", "name" => "TCKN Olmayanlar"],
        ["id" => "50", "name" => "Ödeme Sözü Alındı"],
        ["id" => "51", "name" => "Tekrar Ara"],
        ["id" => "52", "name" => "Ödeme Reddetti"],
        ["id" => "53", "name" => "Yanlış Arama"],
        ["id" => "54", "name" => "Ulaşılamadı"],
        ["id" => "55", "name" => "Teklif Düşünüyor"],
        ["id" => "56", "name" => "İtirazlı Dosya"],
        ["id" => "57", "name" => "Taksitli Ödeme"],
        ["id" => "58", "name" => "Evrak Bekliyor"],
        ["id" => "59", "name" => "İnfaz"],
        ["id" => "99", "name" => "Sonuç Girilmedi"],
    ];
    $liste = collect($sonucListe);
    $sonuc = $liste->where('id' ,$id)->first();
    return $sonuc["name"];
}


