<?php

namespace Modules\Personel\Http\Controllers;

use App\Exports\PuantajExport;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Personel\Entities\Personel;
use Modules\Personel\Entities\Puantaj;
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

        $Ay = \request()->get('ay');
        if(!$Ay)
            $Ay = date('Ym01');
        else
            $Ay = $Ay."01";
        $TamTarih = Carbon::parse($Ay)->format('Y-m-d');

        $baslangic = $TamTarih;
        $bitis = Carbon::parse($TamTarih)->endOfMonth()->format('Y-m-d');
        $personeller = DB::select('
            SELECT *,
                (
                    SELECT
                        SUM(personel_puantaj.fazla_calisma) as fazla_calisma
                    FROM personel_puantaj
                    WHERE user_id=personel.id AND (gun BETWEEN "'.$baslangic.'" AND "'.$bitis.'")
                ) as fazla_mesai,
                (
                    SELECT
                        SUM(personel_puantaj.gec_mesai) as gec_mesai
                    FROM personel_puantaj
                    WHERE user_id=personel.id AND (gun BETWEEN "'.$baslangic.'" AND "'.$bitis.'")
                ) as eksik_mesai

            FROM personel');
       return view('personel::mesai.giriscikis', compact( 'personeller','Aylar'));
    }
    public function giriscikisdetay($user_id){
        $Personel = Personel::findOrFail($user_id);
        $Aylar = [];
        Carbon::setLocale('tr');
        foreach(CarbonPeriod::create('2021-01-01', '1 month', Carbon::now()->format('Y-m-d')) as $ay){
            $Aylar[] = ["id" => $ay->format('Ym'), "label" => $ay->translatedFormat('F Y')];
        }
        $Aylar = collect($Aylar)->sortByDesc('id')->toArray();

        $Ay = \request()->get('ay');
        if(!$Ay)
            $Ay = date('Ym01');
        else
            $Ay = $Ay."01";
        $TamTarih = Carbon::parse($Ay)->format('Y-m-d');

        $baslangic = $TamTarih;
        $bitis = Carbon::parse($TamTarih)->endOfMonth()->format('Y-m-d');
        $Kayitlar = $Personel->Puantaj()->where('gun','>=', $baslangic)->where('gun','<=', $bitis)->get();
        $Kayitlar = Puantaj::query()->where('user_id', $Personel->id)
            ->where('gun', '>=', $baslangic)
            ->where('gun','<=', $bitis)->get();
        return view('personel::mesai.giriscikisdetay', compact('Personel', 'Aylar', 'Kayitlar'));
     }


    public function mesairaporlama(){
        return view('personel::mesai.raporlama');
    }
    public function ExcelIndir(Request $request){
        $Puantaj = Puantaj::query();
        $Ay = date('Ym01');
        if($request->ay)
            $Ay = $request->ay."01";

        $TamTarih = Carbon::parse($Ay)->format('Y-m-d');

        $baslangic = $TamTarih;
        $bitis = Carbon::parse($TamTarih)->endOfMonth()->format('Y-m-d');
        $personeller = DB::select('
            SELECT *,
                (
                    SELECT
                        SUM(personel_puantaj.fazla_calisma) as fazla_calisma
                    FROM personel_puantaj
                    WHERE user_id=personel.id AND (gun BETWEEN "'.$baslangic.'" AND "'.$bitis.'")
                ) as fazla_mesai,
                (
                    SELECT
                        SUM(personel_puantaj.gec_mesai) as gec_mesai
                    FROM personel_puantaj
                    WHERE user_id=personel.id AND (gun BETWEEN "'.$baslangic.'" AND "'.$bitis.'")
                ) as eksik_mesai

            FROM personel');
        $data = [];
//        dd($personeller);
        $data[] = [
            "Puantaj Periyodu",
            "Personel Adı Soyadı",
            "Fazla Çalışma (Dakika)",
            "Eksik Çalışma (Dakika)"
        ];
        foreach ($personeller as $row){
            $data[] = [
                Carbon::parse($TamTarih)->locale('tr')->translatedFormat('Y F'). " Puantajı",
                $row->adsoyad,
                $row->fazla_mesai,
                $row->eksik_mesai
            ];
        }
        $data = new PuantajExport($data);
        return Excel::download($data, 'Puantaj.xlsx');
    }
}
