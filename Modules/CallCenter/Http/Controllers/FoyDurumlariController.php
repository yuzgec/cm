<?php

namespace Modules\CallCenter\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CallCenter\Entities\FoyDurumu;

class FoyDurumlariController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $Liste = FoyDurumu::all();
        $item = new FoyDurumu();
        return view('callcenter::ayarlar.foy_durumlari', compact('Liste', 'item'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('callcenter::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required"
        ]);
        $IcraMudurlugu = new FoyDurumu();
        $IcraMudurlugu->name = $request->name;
        $IcraMudurlugu->save();
        return redirect(route('foy_durumlari.index'));
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
        $Liste = FoyDurumu::all();
        $item = FoyDurumu::findOrFail($id);
        return view('callcenter::ayarlar.foy_durumlari', compact('Liste', 'item'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "name" => "required"
        ]);
        $IcraMudurlugu = FoyDurumu::findOrFail($id);
        $IcraMudurlugu->name = $request->name;
        $IcraMudurlugu->save();
        return redirect(route('foy_durumlari.index'));
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
}
