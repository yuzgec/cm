<?php

namespace App\Helpers;

use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Modules\Ayarlar\Entities\Tatil;

class IzinHesap
{
    public static function IzinHesapla($user_id, $baslangic, $bitis, $tur){
        $User = User::findOrFail($user_id);
        $Mesai = $User->departman()->first()->mesai["Carsamba"];
        $Exp = explode("-", $Mesai);
        $MesaiBaslangic = $Exp[0];
        $MesaiBitis = $Exp[1];



        $Period = CarbonPeriod::create(
            Carbon::parse($baslangic)->format('Y-m-d ' . $MesaiBaslangic.":00"),
            Carbon::parse($bitis)->format('Y-m-d ' . $MesaiBitis.':00')
        );
        $GunlukMesai = static::GunlukMesai($MesaiBaslangic, $MesaiBitis);

        $IzinBaslangic = Carbon::parse($baslangic);
        $IzinBitis = Carbon::parse($bitis);
        $HesaplananSaat = 0;

        foreach ($Period as $item){
            if (static::isTatil($item) == true) continue;

            if($tur == 1){
                if($item->isSunday())
                    continue;
                if($item->isSaturday()){
                    if(static::isTatil($item->subDay()) == true)
                        continue;
                }
            }else{
                if($item->isWeekend())
                    continue;
            }

            if($item->format('Y-m-d') == $IzinBaslangic->format('Y-m-d')){
                $b = $IzinBaslangic;
                if($item > $IzinBaslangic){
                    $b = $item;
                }
                $Fark = Carbon::parse($item->format('Y-m-d ' . $MesaiBitis . ':00'));
                $Fark = $Fark->diffInHours($b);
                $HesaplananSaat+= $Fark;
            }else if($item->format('Y-m-d') == $IzinBitis->format('Y-m-d')){
                $b = $IzinBitis;
                if($b > Carbon::parse($item->format('Y-m-d ' . $MesaiBitis.':00'))){
                    $b = Carbon::parse($item->format('Y-m-d ' . $MesaiBitis.':00'));
                }
                $Fark = $b->diffInHours($item);
                $HesaplananSaat+= $Fark;
            }else{
                $Fark = Carbon::parse($item->format('Y-m-d ' . $MesaiBitis . ':00'));
                $Fark = $Fark->diffInHours(Carbon::parse($item->format('Y-m-d ' . $MesaiBaslangic.':00')));
                $HesaplananSaat+= $Fark;
            }
        }

        $Fark = $HesaplananSaat / $GunlukMesai;
        $Fark = number_format($Fark, 2, ".",".");
        return $Fark;
    }
    public static function GunlukMesai($Baslangic, $Bitis){
        $Baslangic = Carbon::parse(now()->format('Y-m-d ' . $Baslangic. ':00'));
        $Bitis = Carbon::parse(now()->format('Y-m-d ' . $Bitis . ':00'));
        $Fark = $Bitis->diffInHours($Baslangic);
        return $Fark;
    }
    public static function isTatil($Gun){

        $Kontrol = Tatil::query()
            ->whereDate('baslangic', '<=', $Gun->format('Y-m-d'))
            ->whereDate('bitis', '>=', $Gun->format('Y-m-d'));

        if($Kontrol->count() > 0)
            return true;
        return false;

        $Gun = Carbon::parse($Gun->format('Y-m-d 00:00:00'));
        foreach ($Tatiller as $row){
//            dump("if {$row->baslangic->format("Y-m-d")} == {$Gun->format('Y-m-d')}");
            if($row->baslangc == $Gun) {
//                dump($Gun->format('d.m.Y')." Tatil");
            }else{
//                dump($Gun->format('d.m.Y') . " Tatil Değil");
            }
        }
        return false;
    }
}
