<?php

namespace Modules\IK\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Personel\Entities\Mesai;
use Modules\Personel\Entities\Personel;

class IKController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $Personel = Personel::with('mesai')->get();
        return view('ik::index', compact('Personel'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('ik::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('ik::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('ik::edit');
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

    public function takvim(){
        return view('ik::takvim');
    }

    public function calisanlar(){
        $Users = User::with('mesai')->paginate(20);

        //dd($Personel);

        return view('ik::calisanlar', compact('Users'));
    }
    public function calisanDetay($id){
        $PersoneDetay = Personel::find($id);
        return view('ik::calisandetay', compact('PersoneDetay'));
    }

    public function izinler(){
        $Personel = Personel::with('mesai')->paginate(5);
        return view('ik::izinler', compact('Personel'));
    }
}
