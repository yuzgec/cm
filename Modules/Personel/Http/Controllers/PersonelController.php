<?php

namespace Modules\Personel\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Personel\Entities\Personel;
use Modules\Personel\Entities\Mesai;
use Modules\Personel\Http\Requests\PersonelRequest;
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

       $personel = Personel::all();
       return view('personel::mesai.giriscikis', compact('personel'));
    }


    public function giriscikisdetay(){
        $personel = Personel::all();
        return view('personel::mesai.giriscikisdetay', compact('personel'));
     }

    
    public function mesairaporlama(){
        return view('personel::mesai.raporlama');
    }
}
