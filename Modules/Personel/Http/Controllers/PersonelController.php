<?php

namespace Modules\Personel\Http\Controllers;

use App\Exports\MesaiRaporExport;
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

        $Personel = Personel::with('mesai')->get()->sortByDesc('mesai.mesai_renk');;
        //dd($all);
        return view('personel::index', compact('Personel'));
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

        $personel = Personel::with('mesai')->findOrFail($id);
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


    public function mesairaporlama(Request $request){

        $now = Carbon::now();
        if($request->tarih)
            $now = Carbon::parse($request->tarih);
        $HaftaBaslangic = $now->startOfWeek()->format('Y-m-d H:i');
        $HaftaBitis = $now->endOfWeek()->format('Y-m-d H:i');

        $MesaiRapor = Puantaj::with('getUser')->whereBetween('gun', [$HaftaBaslangic, $HaftaBitis])->get();

        $RaporTarih = Carbon::parse($HaftaBaslangic)->translatedFormat('d F Y').' - '.Carbon::parse($HaftaBitis)->translatedFormat('d F Y');
        $Gunler = ['Pazartesi', 'Salı', 'Çarşamba', 'Perşembe', 'Cuma', 'Cumartesi', 'Pazar'];
        $Personeller = [];
        foreach ($MesaiRapor as $Row){
            $Personeller[$Row->user_id][] = $Row;
        }
        return view('personel::mesai.raporlama', compact('MesaiRapor', 'RaporTarih', 'Gunler', 'Personeller', 'HaftaBaslangic'));
    }
     public function MesaiRaporExcelIndir(Request $request){

         $RaporTarih = Carbon::yesterday()->toDateString();
         $now = Carbon::now();
         if($request->tarih)
             $now = Carbon::parse($request->tarih);
         $HaftaBaslangic = $now->startOfWeek()->format('Y-m-d H:i');
         $HaftaBitis = $now->endOfWeek()->format('Y-m-d H:i');


         $MesaiRapor = Puantaj::with('getUser')->whereBetween('gun', [$HaftaBaslangic, $HaftaBitis])->get();

         $data = [];
         $data[] =  ['Personel ID', 'Pazartesi', 'Salı', 'Çarşamba', 'Perşembe', 'Cuma', 'Cumartesi', 'Pazar'];

         foreach ($MesaiRapor as $Row){
             $data[] = $Row->getUser->adsoyad;
             for ($i=0; $i >= 6;$i++){
                 $data[] = $Row->fazla_calisma;
                 $data[] = $Row->gec_mesai;
                 $data[] = substr($Row->mesai_giris, -8);
                 $data[] = substr($Row->mesai_cikis, -8);
             }
         }

         $data = new MesaiRaporExport($data);
         return Excel::download($data, $RaporTarih.' Mesai Rapor.xlsx');
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
    public function ExcelDetayIndir(Request $request){
        $Personel = Personel::findOrFail($request->personel);
        $Ay = date('Ym01');
        if($request->ay)
            $Ay = $request->ay."01";

        $TamTarih = Carbon::parse($Ay)->format('Y-m-d');

        $baslangic = $TamTarih;
        $bitis = Carbon::parse($TamTarih)->endOfMonth()->format('Y-m-d');
        $data = [];
        $data[] = ["Tarih","Mesai Giriş Saati","Geç Giriş","Mesai Çıkış Saait","Fazla Mesai"];
        $Kayitlar = Puantaj::query()->where('user_id', $Personel->id)
            ->where('gun', '>=', $baslangic)
            ->where('gun','<=', $bitis)->get();
        foreach ($Kayitlar as $row){
            $data[] = [
                Carbon::parse($row->gun)->locale('tr')->translatedFormat('d F Y l'),
                $row->mesai_giris->format('H:i'),
                (($row->gec_mesai > 0)?$row->gec_mesai:0),
                $row->mesai_cikis->format('H:i'),
                (($row->fazla_calisma>0)?$row->fazla_calisma:0)
            ];
        }
        $data = new PuantajExport($data);
        return Excel::download($data, 'Puantaj Detay.xlsx');
    }

}
