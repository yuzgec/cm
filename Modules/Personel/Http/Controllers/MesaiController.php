<?php

namespace Modules\Personel\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Personel\Entities\Mesai;

class MesaiController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $all = Mesai::all();
        return view('personel::mesai.index',compact('all'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('personel::mesai.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $mesai = new Mesai;
        //dd($mesai);
        $mesai->mesai_adi       = $request->mesai_adi;
        $mesai->mesai_giris     = $request->mesai_giris;
        $mesai->mesai_cikis     = $request->mesai_cikis;
        $mesai->save();

        return redirect()->route('mesai.index');
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
        $mesai = Mesai::findOrFail($id);
        return view('personel::mesai.edit', compact('mesai'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $mesai = Mesai::findOrFail($id);
        //dd($mesai);
        $mesai->mesai_adi       = $request->mesai_adi;
        $mesai->mesai_giris     = $request->mesai_giris;
        $mesai->mesai_cikis     = $request->mesai_cikis;
        $mesai->save();

        return redirect()->route('mesai.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $sil = Mesai::findOrFail($id);

        $sil->delete();
        return redirect()->route('mesai.index');
    }
}
