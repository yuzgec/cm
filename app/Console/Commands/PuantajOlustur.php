<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Console\Command;
use Modules\Personel\Entities\Monitoring;
use Modules\Personel\Entities\Personel;
use Modules\Personel\Entities\Puantaj;

class PuantajOlustur extends Command
{
    protected $signature = 'puantaj';
    protected $description = 'Command description';
    public function __construct()
    {
        parent::__construct();
    }
    public function handle()
    {
        Carbon::setLocale('tr');
        $SonTarih = Puantaj::query()->orderByDesc('gun')->limit(1);
        if($SonTarih->count()<1)
            $SonTarih = "2021-01-06";
        else
            $SonTarih = $SonTarih->first()->gun->format('Y-m-d');
        $Tarihler = CarbonPeriod::create($SonTarih, Carbon::now()->subDay()->format('Y-m-d'));
        foreach(User::query()->whereNotNull('remote_id')->get() as $Personel){
            $Mesai = $Personel->departman()->first();
            $MesaiBitisSaati = $Mesai->mesai_bitis;
            dump($Personel->full_name." İşleniyor...");
            foreach($Tarihler as $Tarih){
                if($Tarih->isFriday())
                    $MesaiBitisSaati = "17:00:00";
                else
                    $MesaiBitisSaati = $Mesai->mesai_bitis;
                $PuantajKontrol = Puantaj::query()->where('user_id', $Personel->id)->where('gun', $Tarih->format('Y-m-d'));
                if($PuantajKontrol->count() > 0){
                    dump($Tarih->format('d.m.Y') . " için puantaj kaydı mevcut");
                    continue;
                }
                $GirisFarki = 0;
                $CikisFarki = 0;

                //BEGIN Giriş Hesaplaması
                $Giris = Monitoring::query()->where('SicilID', $Personel->remote_id)
                    ->whereDate('Eventtime', $Tarih->format('Y-m-d'))
                    ->where('TerminalID', 3)
                    ->orderBy('Eventtime')
                    ->first();
                if(!$Giris)
                    continue;
                $MesaiBaslangic = Carbon::parse($Tarih->format('Y-m-d')." ".$Mesai->mesai_baslangic)->format('Y-m-d H:i:s');
                $BaslangicFarki = Carbon::parse($MesaiBaslangic)->diffInMinutes($Giris->Eventtime, false);
                if($BaslangicFarki < 0 )
                    $BaslangicFarki = 0;
                // END Giriş Hesaplaması

                //BEGIN Çıkış Hesaplaması
                $Cikis = Monitoring::query()->where('SicilID', $Personel->remote_id)
                    ->whereDate('Eventtime', $Tarih->format('Y-m-d'))
                    ->where('TerminalID', 1)
                    ->orderByDesc('Eventtime')
                    ->first();
                $CikisSaati = null;
                if(!$Cikis)
                    $CikisSaati = $Tarih->format('Y-m-d') . " " . $MesaiBitisSaati;
                else
                    $CikisSaati = $Cikis->Eventtime;

                $MesaiBitis = Carbon::parse($Tarih->format('Y-m-d'). " " . $MesaiBitisSaati)->format('Y-m-d H:i:s');
                $BitisFarki = Carbon::parse($MesaiBitis)->diffInMinutes($CikisSaati, false);
                if($BitisFarki<0)
                    $BitisFarki = 0;
                $Puantaj = new Puantaj();
                $Puantaj->user_id = $Personel->id;
                $Puantaj->gun = $Tarih->format('Y-m-d');
                $Puantaj->calisma_gun = 1;
                $Puantaj->fazla_calisma = $BitisFarki;
                $Puantaj->gec_mesai = $BaslangicFarki;
                $Puantaj->mesai_giris = $Giris->Eventtime;
                $Puantaj->mesai_cikis = $CikisSaati;
                $Puantaj->save();
                dump($Personel->adsoyad." " . $Tarih->translatedFormat('d F Y')." Puantajı İşlendi");
            }
        }
    }
}
