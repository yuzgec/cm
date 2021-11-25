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
        $baslangic = Carbon::now()->startOfMonth()->format('Y-m-d');
        $bitis = Carbon::now()->addDays('-1')->format('Y-m-d');
        $personeller = Personel::with('mesai')->get();
        $Kayitlar = [];
        foreach ($personeller as $personel){
            $gecMesai = 0;
            $fazlaCalisma = 0;
            $calismaGunSayisi = 0;
            $data = $personel;
            $period = CarbonPeriod::create($baslangic, $bitis);
            foreach($period as $row){
                $gunBasi = $row->format('Y-m-d')." " . $personel->mesai->mesai_giris;
                $gunSonu = $row->format('Y-m-d')." " . $personel->mesai->mesai_cikis;
                $tamGunEksi = Carbon::parse($gunBasi)->diffInMinutes($gunSonu);
                $pazarlar = [];
                $calismagunler = [];

                $Kontrol = DB::table('personel_puantaj')->where('user_id', $personel->id)->where('gun', $row->format('Y-m-d'));
                if($Kontrol->count()>0){
                    $Kontrol = $Kontrol->first();
                    $gecMesai+= $Kontrol->gec_mesai;
                    $fazlaCalisma+= $Kontrol->fazla_calisma;
                    $calismaGunSayisi+= $Kontrol->calisma_gun;
                }else{
                    if($row->isSunday() || $row->isSaturday()){
                        //echo $row->format('d.m.Y'). " Hafta Tatili <br />";
                    }else{
                        $Girisler = $personel->Monitoring()
                            ->where('TerminalID', 3)
                            ->whereDate('Eventtime','=', $row->format('Y-m-d'))
                            ->orderBy('Eventtime','ASC');
                        if($Girisler->count()<1){
                            $gecMesai+= $tamGunEksi;
                            //echo "Tüm gün gelmemiş <br />";
                        }else{
                            $calismaGunSayisi++;
                            $baslangicFark = Carbon::parse($gunBasi)->diffInMinutes($Girisler->first()->Eventtime);
                            if($baslangicFark > 0){
                                $gecMesai+= $baslangicFark;
                            }
                            $Cikislar = $personel->Monitoring()
                                ->where('TerminalID', 3)
                                ->whereDate('Eventtime','=', $row->format('Y-m-d'))
                                ->orderBy('Eventtime','DESC');
                            $bitisFark = Carbon::parse($gunSonu)->diffInMinutes($Cikislar->first()->Eventtime);
                            if($bitisFark>0){
                                $fazlaCalisma+= $bitisFark;
                            }
                            //echo $row->format('d.m.Y')." Normal gün ". " - " . $baslangicFark ." Dakika Geç - ". $bitisFark." Dakika Fazla Çalışma<br />";
                        }
                    }
                    DB::table('personel_puantaj')->insert([
                        "user_id" => $personel->id,
                        "gun" => $row->format('Y-m-d'),
                        "calisma_gun" => 1,
                        "fazla_calisma" => $fazlaCalisma,
                        "gec_mesai" =>$gecMesai
                    ]);
                }

            }
            $data->gecMesai = $gecMesai;
            $data->fazlaCalisma = $fazlaCalisma;
            $data->calismaGunSayisi = $calismaGunSayisi;
            $Kayitlar[] = $data;
        }
       return view('personel::mesai.giriscikis', compact('Kayitlar', 'personeller'));
    }


    public function giriscikisdetay($user_id){

        $baslangic = "2021-11-01";
        $bitis = "2021-11-24";

        $personel       = Personel::findOrFail($user_id);
        $monitoring     = Monitoring::where('UserID', $personel->remote_id)
        ->where('Eventtime', '>=', $baslangic)
        ->where('Eventtime','<=', $bitis)
        ->paginate(20);

        return view('personel::mesai.giriscikisdetay', compact('personel', 'monitoring'));
     }


    public function mesairaporlama(){
        return view('personel::mesai.raporlama');
    }
}
