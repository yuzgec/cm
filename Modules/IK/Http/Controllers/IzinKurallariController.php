<?php

namespace Modules\IK\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\IK\Entities\IzinKurallari;

class IzinKurallariController extends Controller
{

    public function index()
    {
        $IzinKurallari = IzinKurallari::all();
        return view('ik::izinkurallari.index',compact('IzinKurallari'));
    }

    public function create()
    {
        return view('ik::izinkurallari.create');
    }


    public function store(Request $request)
    {
        $IzinKurallari = new IzinKurallari;
        $IzinKurallari->izin_adi =  $request->izin_adi;
        $IzinKurallari->save();

        return redirect()->route('izinkurallari.index');

    }

    public function show($id)
    {
        return view('ik::show');
    }


    public function edit($id)
    {
        return view('ik::izinkurallari.edit');
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
