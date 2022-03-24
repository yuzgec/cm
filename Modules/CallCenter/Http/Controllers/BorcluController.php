<?php

namespace Modules\CallCenter\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CallCenter\Entities\Borclu;

class BorcluController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $Liste = Borclu::paginate();
        $item = new Borclu();
        return view('callcenter::borclu',compact('Liste','item'));
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
            "name" => "unvan"
        ]);
        $Alacakli = new Borclu();
        $Alacakli->unvan = $request->unvan;
        $Alacakli->tc = $request->tc;
        $Alacakli->adres = $request->adres;
        $Alacakli->il = $request->il;
        $Alacakli->ilce = $request->ilce;
        $Alacakli->save();
        return redirect(route('borclu.index'));
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
        $Liste = Borclu::paginate();
        $item = Borclu::findOrFail($id);
        return view('callcenter::borclu', compact('Liste', 'item'));
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
            "name" => "unvan"
        ]);
        $Alacakli = Borclu::findOrFail(id);
        $Alacakli->unvan = $request->unvan;
        $Alacakli->tc = $request->tc;
        $Alacakli->adres = $request->adres;
        $Alacakli->il = $request->il;
        $Alacakli->ilce = $request->ilce;
        $Alacakli->save();
        return redirect(route('borclu.index'));
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
