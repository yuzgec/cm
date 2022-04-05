<?php

namespace Modules\CallCenter\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CallCenter\Entities\BedeniHasar;
use Modules\CallCenter\Entities\BedeniHasarGorusme;
use Modules\CallCenter\Entities\Gorusme;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Xls;

class BedeniHasarController extends Controller
{
    public $sonucListe = ["" => "Seçin", "0" => "Cevapsız","1" => "Yarıda Kesildi","2" => "Müsait Değil","3" => "Yanlış Arama","4" => "Meşgul","5" => "Kapalı","7" => "Uygunsuz Arama","8" => "Şikayet","9" => "Genel Bilgi","10" => "Müşteriyi Geç","11" => "Numara Kullanılmıyor","12" => "Numara Yok","13" => "TCKN Olmayanlar","50" => "Ödeme Sözü Alındı","51" => "Tekrar Ara","52" => "Ödeme Reddetti","53" => "Yanlış Arama","54" => "Ulaşılamadı","55" => "Teklif Düşünüyor","56" => "İtirazlı Dosya","57" => "Taksitli Ödeme","58" => "Evrak Bekliyor","59" => "İnfaz","99" => "Sonuç Girilmedi"];
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {

        $Dosyalar = BedeniHasar::query();
        if(\request()->get('q')){
            $q = \request()->get('q');
            $Dosyalar->Where('vaka_turu','like', '%'.$q.'%')
                ->orWhere('sube','like', '%'.$q.'%')
                ->orWhere('hastane','like', '%'.$q.'%')
                ->orWhere('yetkili','like', '%'.$q.'%')
                ->orWhere('m_tarihi','like', '%'.$q.'%')
                ->orWhere('hasta','like', '%'.$q.'%')
                ->orWhere('tc','like', '%'.$q.'%')
                ->orWhere('telefon1','like', '%'.$q.'%')
                ->orWhere('telefon2','like', '%'.$q.'%')
                ->orWhere('bilgi','like', '%'.$q.'%')
                ->orWhere('adli_muayene','like', '%'.$q.'%')
                ->orWhere('parti_ismi','like', '%'.$q.'%')
                ->orWhere('il','like', '%'.$q.'%')
                ->orWhere('hastane_bolum','like', '%'.$q.'%')
                ->orWhere('tedavi_turu','like', '%'.$q.'%')
            ;
        }
        $Dosyalar = $Dosyalar->latest()->paginate();
        return view('callcenter::bedenihasar.index', compact('Dosyalar'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $Dosya = new BedeniHasar();
        return view('callcenter::bedenihasar.create', compact(
            'Dosya'
        ));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
//        $request->validate([
//            "grup" => "required",
//            "form_turu" => "required",
//            "alacakli_id" => "required",
//            "borclu_id" => "required",
//            "foy_no" => "required",
//            "icra_dosya_no" => "required",
//            "icra_mudurlugu" => "required",
//            "foy_durumu" => "required",
//            "tutar" => "required",
//            "takip_tarihi" => "required",
//        ]);

        $Dosya = new BedeniHasar();
        $Dosya->vaka_turu = $request->vaka_turu;
        $Dosya->sube = $request->sube;
        $Dosya->hastane = $request->hastane;
        $Dosya->yetkili = $request->yetkili;
        $Dosya->hasta = $request->hasta;
        $Dosya->tc = $request->tc;
        $Dosya->telefon1 = $request->telefon1;
        $Dosya->telefon2 = $request->telefon2;
        $Dosya->bilgi = $request->bilgi;
        $Dosya->adli_muayene = $request->adli_muayene;
        $Dosya->parti_ismi = $request->parti_ismi;
        $Dosya->il = $request->il;
        $Dosya->kaynak = $request->kaynak;
        $Dosya->hastane_bolum = $request->hastane_bolum;
        $Dosya->tedavi_turu = $request->tedavi_turu;
        $Dosya->ikamet_adresi = $request->ikamet_adresi;
        $Dosya->m_tarihi = Carbon::parse($request->m_tarihi)->format('Y-m-d');
        $Dosya->save();
        return redirect(route('bedenihasar.index'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $Dosya = BedeniHasar::findOrFail($id);
        $Gorusme = new BedeniHasarGorusme();
        $SonucListe = $this->sonucListe;
        return view('callcenter::bedenihasar.show', compact('Dosya', 'Gorusme', 'SonucListe'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $Dosya = BedeniHasar::findOrFail($id);
        return view('callcenter::bedenihasar.edit', compact('Dosya'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
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

    public function excelyukle(){
        return view('callcenter::bedenihasar.excelyukle');
    }
    public function exceloku(Request $request){
        $uploadedFile = $request->file('upload');
        $uploadedFile->move(storage_path('app/tmp'), $uploadedFile->getClientOriginalName());
        $path = storage_path('app/tmp/'.$uploadedFile->getClientOriginalName());
        $ftype = IOFactory::identify($path);
        $reader = IOFactory::createReader($ftype);
        $ss = $reader->load($path);
        $s = $ss->getActiveSheet();
        $rows = $s->toArray();
        $columns = $rows[0];
        $fileName = $path;
        return view('callcenter::bedenihasar.excelyukle', compact('columns','fileName'));
    }
    public function excelisle(Request $request){
//        dd($request->all());
        $ftype = IOFactory::identify($request->filePath);
        $reader = IOFactory::createReader($ftype);
        $ss = $reader->load($request->filePath);
        $s = $ss->getActiveSheet();
        $rows = $s->toArray();

        $data = [];
        $i = 0;
        for($i=1;$i<count($rows);$i++){
            $row = $rows[$i];
            $data[] = [
                "vaka_turu" => $row[$request->vaka_turu],
                "sube" => $row[$request->sube],
                "hastane" => $row[$request->hastane],
                "yetkili" => $row[$request->yetkili],
                "m_tarihi" => Carbon::parse($row[$request->m_tarihi])->format('Y-m-d'),
                "hasta" => $row[$request->hasta],
                "tc" => $row[$request->tc],
                "telefon1" => $row[$request->telefon1],
                "telefon2" => $row[$request->telefon2],
                "bilgi" => $row[$request->bilgi],
                "adli_muayene" => $row[$request->adli_muayene],
                "parti_ismi" => $row[$request->parti_ismi],
                "il" => $row[$request->il],
                "kaynak" => $row[$request->kaynak],
                "hastane_bolum" => $row[$request->hastane_bolum],
                "tedavi_turu" => $row[$request->tedavi_turu],
                "ikamet_adresi" => $row[$request->ikamet_adresi],
                "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
                "updated_at" => Carbon::now()->format('Y-m-d H:i:s'),
            ];
        }

        $data = collect($data);
        $data = $data->chunk(999);
        foreach($data as $row){
            BedeniHasar::query()->insert($row->toArray());
        }

        return redirect(route('bedenihasar.index'));
    }
    public function gorusmeKaydet(Request $request, $dosyaId){

        $request->validate(
            [
                "telefon" => "required",
                "detay" => "required",
                "tarih" => "required",
                "sonuc" => "required",
            ]
        );

        $Gorusme = new BedeniHasarGorusme();
        $Gorusme->user_id = auth()->user()->id;
        $Gorusme->dosya_id = $dosyaId;
        $Gorusme->telefon = $request->telefon;
        $Gorusme->detay = $request->detay;
        $Gorusme->tarih = Carbon::parse($request->tarih)->format('Y-m-d H:i:s');
        $Gorusme->sonuc = $request->sonuc;
        $Gorusme->save();
        return redirect(route("bedenihasar.show", $dosyaId));
    }
}
