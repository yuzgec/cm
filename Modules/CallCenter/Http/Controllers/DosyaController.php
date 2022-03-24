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

class DosyaController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $Dosyalar = Dosya::query()->latest()->get();

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

        $Sutunlar = ['id' => 'Sutun 1', 'name' => 'Sutun 2', 'surname' => 'Sutun 3', 'email' => 'Sutun 4', 'phone' => 'Sutun 5'];
        return view('callcenter::dosya.excelyukle', compact('Sutunlar'));
    }
}
