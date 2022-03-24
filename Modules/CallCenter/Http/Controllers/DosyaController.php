<?php

namespace Modules\CallCenter\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CallCenter\Entities\Alacakli;
use Modules\CallCenter\Entities\Borclu;
use Modules\CallCenter\Entities\Dosya;
use Modules\CallCenter\Entities\DosyaGrubu;
use Modules\CallCenter\Entities\FormTuru;
use Modules\CallCenter\Entities\FoyDurumu;
use Modules\CallCenter\Entities\IcraMudurlugu;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Xls;

class DosyaController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $Dosyalar = Dosya::query()->latest()->paginate();
        return view('callcenter::dosya.index', compact('Dosyalar'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $Gruplar = DosyaGrubu::all()->pluck('name','id');
        $Alacaklilar = Alacakli::all()->pluck('unvan','id');
        $Borclular = Borclu::all()->pluck('unvan','id');
        $FoyDurumlari = FoyDurumu::all()->pluck('name','id');
        $IcraMudurlukleri = IcraMudurlugu::all()->pluck('name','id');
        $FormTurleri = FormTuru::all()->pluck('name','id');
        return view('callcenter::dosya.create', compact(
            'Gruplar',
            'Alacaklilar',
            'Borclular',
            'FoyDurumlari',
            'IcraMudurlukleri',
            'FormTurleri'
        ));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            "grup" => "required",
            "form_turu" => "required",
            "alacakli_id" => "required",
            "borclu_id" => "required",
            "foy_no" => "required",
            "icra_dosya_no" => "required",
            "icra_mudurlugu" => "required",
            "foy_durumu" => "required",
            "tutar" => "required",
            "takip_tarihi" => "required",
        ]);

        $Dosya = new Dosya();
        $Dosya->grup = $request->grup;
        $Dosya->form_turu = $request->form_turu;
        $Dosya->alacakli_id = $request->alacakli_id;
        $Dosya->borclu_id = $request->borclu_id;
        $Dosya->foy_no = $request->foy_no;
        $Dosya->icra_dosya_no = $request->icra_dosya_no;
        $Dosya->icra_mudurlugu = $request->icra_mudurlugu;
        $Dosya->foy_durumu = $request->foy_durumu;
        $Dosya->tutar = $request->tutar;
        $Dosya->takip_tarihi = Carbon::parse($request->takip_tarihi)->format('Y-m-d');
        $Dosya->save();
        return redirect(route('dosya.index'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('callcenter::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('callcenter::dosya.edit');
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
        return view('callcenter::dosya.excelyukle');
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
        return view('callcenter::dosya.excelyukle', compact('columns','fileName'));
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
                "klasor" => $row[$request->klasor],
                "foy_no" => $row[(int)$request->foy_no],
                "takip_tarihi" => Carbon::parse($row[$request->takip_tarihi])->format('Y-m-d'),
                "alacakli_adi" => $row[$request->alacakli_adi],
                "borclu_adi" => $row[$request->borclu_adi],
                "tc" => $row[$request->tc],
                "borclu_tc" => $row[$request->borclu_tc],
                "icra_dosya_no" => $row[$request->icra_dosya_no],
                "icra_mudurlugu" => $row[$request->icra_mudurlugu],
                "form_turu" => $row[$request->form_turu],
                "alacak" => $row[$request->alacak],
                "para_birimi" => $row[$request->para_birimi],
                "telefon1" => $row[$request->telefon_1],
                "telefon2" => $row[$request->telefon_2],
                "telefon3" => $row[$request->telefon_3],
                "telefon4" => $row[$request->telefon_4],
                "telefon5" => $row[$request->telefon_5],
                "foy_durumu" => $row[$request->foy_durumu],
                "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
                "updated_at" => Carbon::now()->format('Y-m-d H:i:s'),
            ];
        }

        $data = collect($data);
        $data = $data->chunk(999);
        foreach($data as $row){
            Dosya::query()->insert($row->toArray());
        }
    }
}
