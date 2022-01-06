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
use Modules\IK\Entities\Varyant;
use Modules\Personel\Entities\Personel;
use Modules\Personel\Entities\PersonelBilgileri;
use Modules\Personel\Entities\Puantaj;
use Modules\Personel\Entities\SicilRemote;
use Modules\Personel\Entities\Mesai;
use Modules\Personel\Http\Requests\PersonelRequest;
use Modules\Personel\Entities\Monitoring;

class PersonelController extends Controller
{

    public function index()
    {

        $Personel = Personel::with('mesai')->get()->sortByDesc('mesai.mesai_renk');;
        return view('personel::index', compact('Personel'));
    }

    public function create()
    {
        $mesai = Mesai::all();
        return view('personel::create',compact('mesai'));
    }

    public function store(PersonelRequest $request)
    {
        DB::transaction(function () use($request) {
            $personel = new Personel;
            $personel->adsoyad = $request->adsoyad;
            $personel->telefon = $request->telefon;
            $personel->email = $request->email;
            $personel->tckn = $request->tckn;
            $personel->mesai_id = $request->mesai_id;
            $personel->durum = $request->durum;

            $personel->save();

            $Pb = PersonelBilgileri::create([
                'personel_id' => $personel->id,
                'ise_baslama_tarihi' => $request->ise_baslama_tarihi,
                'kisisel_eposta' => $request->kisisel_eposta,
                'kisisel_telefon' => $request->kisisel_telefon,
                'erisim_turu' => $request->erisim_turu,
                'sozlesme_turu' => $request->sozlesme_turu
            ]);

        });

        return redirect()->route('personel.index');

    }

    public function show($id)
    {
        return view('personel::show');
    }


    public function edit($id)
    {
        $Personel = Personel::with('mesai')->with('Bilgiler')->findOrFail($id);
        $Mesai = Mesai::all();
        $Varyant =  Varyant::all();

        return view('personel::edit', compact('Personel','Mesai', 'Varyant'));
    }

    public function update(Request $request, $id)
    {
        //dd($request->all());
        DB::transaction(function () use($request, $id) {

            $Personel = Personel::findOrFail(request('id'));

            $Personel->adsoyad = $request->adsoyad;
            $Personel->telefon = $request->telefon;
            $Personel->email = $request->email;
            $Personel->tckn = $request->tckn;
            $Personel->mesai_id = $request->mesai_id;
            $Personel->durum = $request->durum;
            $Personel->save();

            if ($request->hasFile('image')) {
                $Personel->media()->delete();
                $Personel->addMedia($request->image)->toMediaCollection();
            }

            $Pb = PersonelBilgileri::findOrFail($id);
            $Pb->ise_baslama_tarihi = $request->ise_baslama_tarihi;
            $Pb->dogum_tarihi = $request->dogum_tarihi;
            $Pb->kisisel_eposta = $request->kisisel_eposta;
            $Pb->kisisel_telefon = $request->kisisel_telefon;
            $Pb->erisim_turu = $request->erisim_turu;
            $Pb->sozlesme_turu = $request->sozlesme_turu;
            $Pb->personel_grubu = $request->personel_grubu;
            $Pb->medeni_hal = $request->medeni_hal;
            $Pb->cinsiyet = $request->cinsiyet;
            $Pb->engel_derecesi = $request->engel_derecesi;
            $Pb->uyrugu = $request->uyrugu;
            $Pb->cocuk_sayisi = $request->cocuk_sayisi;
            $Pb->askerlik_durumu = $request->askerlik_durumu;
            $Pb->kan_grubu = $request->kan_grubu;
            $Pb->egitim_durumu = $request->egitim_durumu;
            $Pb->mezuniyet = $request->mezuniyet;
            $Pb->mezun_okul = $request->mezun_okul;
            $Pb->adres = $request->adres;
            $Pb->adres_telefon = $request->adres_telefon;
            $Pb->adres_ulke = $request->adres_ulke;
            $Pb->adres_sehir = $request->adres_sehir;
            $Pb->adres_postakodu = $request->adres_postakodu;
            $Pb->banka_adi = $request->banka_adi;
            $Pb->banka_hesap_tipi = $request->banka_hesap_tipi;
            $Pb->banka_hesap_no = $request->banka_hesap_no;
            $Pb->banka_iban = $request->banka_iban;
            $Pb->acil_kisi = $request->acil_kisi;
            $Pb->acil_yakinlik = $request->acil_yakinlik;
            $Pb->acil_telefon = $request->acil_telefon;
            $Pb->sosyalmedya_adi = $request->sosyalmedya_adi;
            $Pb->sosyalmedya_baglanti = $request->sosyalmedya_baglanti;
            $Pb->save();
        });

        return redirect()->route('personel.index');
    }

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
