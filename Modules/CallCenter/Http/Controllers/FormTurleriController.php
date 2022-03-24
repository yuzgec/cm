<?php

namespace Modules\CallCenter\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CallCenter\Entities\FormTuru;

class FormTurleriController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $Liste = FormTuru::all();
        $item = new FormTuru();
        return view('callcenter::ayarlar.form_turleri', compact('Liste', 'item'));
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
        $IcraMudurlugu = new FormTuru();
        $IcraMudurlugu->name = $request->name;
        $IcraMudurlugu->save();
        return redirect(route('form_turleri.index'));
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
        $Liste = FormTuru::all();
        $item = FormTuru::findOrFail($id);
        return view('callcenter::ayarlar.form_turleri', compact('Liste', 'item'));
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
        $IcraMudurlugu = FormTuru::findOrFail($id);
        $IcraMudurlugu->name = $request->name;
        $IcraMudurlugu->save();
        return redirect(route('form_turleri.index'));
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
