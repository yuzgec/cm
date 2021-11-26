<?php

namespace Modules\Personel\Http\Controllers;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Personel\Entities\Personel;
use Modules\Personel\Entities\SicilRemote;
use Modules\Personel\Entities\Mesai;
use Modules\Personel\Http\Requests\PersonelRequest;
use Modules\Personel\Entities\Monitoring;
class PersonelController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {

        $all = Personel::with('mesai')->get();
        //dd($all);
        return view('personel::index', compact('all'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $mesai = Mesai::all();
        return view('personel::create',compact('mesai'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(PersonelRequest $request)
    {
        $personel = new Personel;

        $personel->adsoyad      =  $request->adsoyad;
        $personel->telefon      =  $request->telefon;
        $personel->email        =  $request->email;
        $personel->tckn         =  $request->tckn;
        $personel->mesai_id     =  $request->mesai_id;
        $personel->durum        =  $request->durum;


        $personel->save();

        return redirect()->route('personel.index');

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('personel::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {

        $personel = Personel::findOrFail($id);
        $mesai = Mesai::all();

        return view('personel::edit', compact('personel','mesai'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(PersonelRequest $request, $id)
    {
        $personel = Personel::findOrFail($id);
       //dd($personel);
        $personel->adsoyad      =  $request->adsoyad;
        $personel->telefon      =  $request->telefon;
        $personel->email        =  $request->email;
        $personel->tckn         =  $request->tckn;
        $personel->mesai_id     =  $request->mesai_id;
        $personel->durum        =  $request->durum;

        $personel->save();

        return redirect()->route('personel.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }

    public function giriscikis(){
        $baslangic = Carbon::parse('2021-10-01')->format('Y-m-d');
        $bitis = Carbon::parse('2021-10-31')->format('Y-m-d');
        $personeller = Personel::with('mesai')->get();
        $Kayitlar = [];
        foreach ($personeller as $personel){
            $gecMesai = 0;
            $fazlaCalisma = 0;
            $calismaGunSayisi = 0;
            $data = $personel;
            $period = CarbonPeriod::create($baslangic, $bitis);
            $mesaiBaslangic = $personel->mesai->mesai_giris;
            $mesaiBitis = $personel->mesai->mesai_cikis;
            foreach($period as $row){
                $Kayit = PuantajGetir($personel, $row->format('Y-m-d'), $mesaiBaslangic, $mesaiBitis);
                if(!$Kayit)
                    continue;
                $gecMesai+= $Kayit->gec_mesai;
                $fazlaCalisma+= $Kayit->fazla_calisma;
                $calismaGunSayisi++;
//                $gunBasi = $row->format('Y-m-d')." " . $personel->mesai->mesai_giris;
//                $gunSonu = $row->format('Y-m-d')." " . $personel->mesai->mesai_cikis;
//                $tamGunEksi = Carbon::parse($gunBasi)->diffInMinutes($gunSonu);
//
//                $pazarlar = [];
//                $calismagunler = [];
//
//                $Kontrol = DB::table('personel_puantaj')->where('user_id', $personel->id)->where('gun', $row->format('Y-m-d'));
//                if($Kontrol->count()>0){
//                    $Kontrol = $Kontrol->first();
//                    $gecMesai+= $Kontrol->gec_mesai;
//                    $fazlaCalisma+= $Kontrol->fazla_calisma;
//                    $calismaGunSayisi+= $Kontrol->calisma_gun;
//                }else{
//                    if($row->isSunday() || $row->isSaturday()){
//                        //echo $row->format('d.m.Y'). " Hafta Tatili <br />";
//                    }else{
//                        $Girisler = $personel->Monitoring()
//                            ->where('TerminalID', 3)
//                            ->whereDate('Eventtime','=', $row->format('Y-m-d'))
//                            ->orderBy('Eventtime','ASC');
//                        if($Girisler->count()<1){
//                            $gecMesai+= $tamGunEksi;
//                            //echo "Tüm gün gelmemiş <br />";
//                        }else{
//                            $calismaGunSayisi++;
//                            $baslangicFark = Carbon::parse($gunBasi)->diffInMinutes($Girisler->first()->Eventtime);
//                            if($baslangicFark > 0){
//                                $gecMesai+= $baslangicFark;
//                            }
//                            $Cikislar = $personel->Monitoring()
//                                ->where('TerminalID', 3)
//                                ->whereDate('Eventtime','=', $row->format('Y-m-d'))
//                                ->orderBy('Eventtime','DESC');
//                            $bitisFark = Carbon::parse($gunSonu)->diffInMinutes($Cikislar->first()->Eventtime);
//                            if($bitisFark>0){
//                                $fazlaCalisma+= $bitisFark;
//                            }
//                            //echo $row->format('d.m.Y')." Normal gün ". " - " . $baslangicFark ." Dakika Geç - ". $bitisFark." Dakika Fazla Çalışma<br />";
//                        }
//                    }
//                    DB::table('personel_puantaj')->insert([
//                        "user_id" => $personel->id,
//                        "gun" => $row->format('Y-m-d'),
//                        "calisma_gun" => 1,
//                        "fazla_calisma" => $bitisFark,
//                        "gec_mesai" =>$baslangicFark
//                    ]);
//                }

            }
            $data->gecMesai = $gecMesai;
            $data->fazlaCalisma = $fazlaCalisma;
            $data->calismaGunSayisi = $calismaGunSayisi;
            $Kayitlar[] = $data;
        }
       return view('personel::mesai.giriscikis', compact('Kayitlar', 'personeller'));
    }
    public function Test($Id){
        $baslangic = Carbon::now()->startOfMonth()->format('Y-m-d');
        $bitis = Carbon::now()->addDays('-1')->format('Y-m-d');
        $Personel = Personel::findOrFail($Id);
        dd($Personel->mesai);
    }

    public function giriscikisdetay($user_id){
        $Baslangic = "2021-10-01";
        $Bitis = "2021-10-31";
        $Personel = Personel::findOrFail($user_id);
        $period = CarbonPeriod::create($Baslangic, $Bitis);
        $MesaiBaslangic = $Personel->mesai->mesai_giris;
        $MesaiBitis = $Personel->mesai->mesai_cikis;
        $Gunler = [];
        $ToplamEksi = 0;
        $ToplamArti = 0;
        foreach ($period as $tarih){
            $Kayit = PuantajGetir($user_id, $tarih->format('Y-m-d'));
            if(!$Kayit)
                continue;
            $ToplamEksi+= $Kayit->gec_mesai;
            $ToplamArti+= $Kayit->fazla_calisma;

            $Gunler[] = [
                "Tarih" => $tarih,
                "MesaiBaslangic" => Carbon::parse($MesaiBaslangic)->format('d.m.Y H:i:s'),
                "MesaiBitis" => Carbon::parse($MesaiBitis)->format('d.m.Y H:i:s'),
                "IseGirisSaati" => Carbon::parse($Kayit->mesai_giris)->format('H:i'),
                "GirisFark" => $Kayit->gec_mesai,
                "CikisSaati" => Carbon::parse($Kayit->mesai_cikis)->format('H:i'),
                "CikisFark" => $Kayit->fazla_calisma
            ];
        }

        return view('personel::mesai.giriscikisdetay', compact('Personel', 'Gunler', 'ToplamArti','ToplamEksi'));
     }


    public function mesairaporlama(){
        return view('personel::mesai.raporlama');
    }
}
