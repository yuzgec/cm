<?php

namespace Modules\IK\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\IK\Entities\Varyant;

class VaryantController extends Controller
{

    public function index()
    {
        $Varyant =  Varyant::with('sub')->whereNull('parent_id')->get();
        //dd($Varyant);
        return view('ik::varyant.index', compact('Varyant'));
    }

    public function create()
    {
        $Varyant =  Varyant::whereNull('parent_id')->get();
        return view('ik::varyant.create',compact('Varyant'));
    }


    public function store(Request $request)
    {
        $Varyant =  new Varyant;
        $Varyant->varyant_adi = $request->varyant_adi;
        $Varyant->parent_id = $request->parent_id;
        $Varyant->save();
        return redirect()->route('varyant.index');
     }

    public function show($id)
    {
        return view('ik::show');
    }

    public function edit($id)
    {
        $Varyant = Varyant::findOrFail($id);
        $VaryantListesi = Varyant::all();
        $Varyantlar = Varyant::where('parent_id', $id)->get();

        return view('ik::varyant.edit', compact('Varyant', 'VaryantListesi', 'Varyantlar'));
    }


    public function update(Request $request, $id)
    {
        $Varyant = Varyant::findOrFail($id);
        $Varyant->varyant_adi = $request->varyant_adi;
        $Varyant->parent_id = $request->parent_id;
        $Varyant->save();

        return redirect()->route('varyant.index');
    }

    public function destroy($id)
    {

    }
}
