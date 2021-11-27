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
        $Aylar = [];
        Carbon::setLocale('tr');
        foreach(CarbonPeriod::create('2021-01-01', '1 month', Carbon::now()->format('Y-m-d')) as $ay){
            $Aylar[] = ["id" => $ay->format('Ym'), "label" => $ay->translatedFormat('F Y')];
        }
        $Aylar = collect($Aylar)->sortByDesc('id')->toArray();


        $baslangic = Carbon::parse('2021-10-01')->format('Y-m-d');
        $bitis = Carbon::parse('2021-10-31')->format('Y-m-d');
        $personeller = DB::select('
            SELECT *,
                (
                    SELECT
                        SUM(personel_puantaj.fazla_calisma) as fazla_calisma
                    FROM personel_puantaj
                    WHERE user_id=personel.id AND (gun BETWEEN "2021-10-01" AND "2021-10-31")
                ) as fazla_mesai,
                (
                    SELECT
                        SUM(personel_puantaj.gec_mesai) as gec_mesai
                    FROM personel_puantaj
                    WHERE user_id=personel.id AND (gun BETWEEN "2021-10-01" AND "2021-10-31")
                ) as eksik_mesai

            FROM personel');
       return view('personel::mesai.giriscikis', compact( 'personeller','Aylar'));
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
            $Kayit = PuantajGetir($Personel, $tarih->format('Y-m-d'), $MesaiBaslangic, $MesaiBitis);
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
