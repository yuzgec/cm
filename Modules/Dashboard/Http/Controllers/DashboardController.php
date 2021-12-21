<?php

namespace Modules\Dashboard\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Odeme\Entities\Odeme;
use Modules\Personel\Entities\Personel;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $UserCount = User::all()->count();
        $PersonelCount = Personel::all()->count();
        $OdemeListesi = Odeme::with('getPersonel')->where('odeme_cevap', 1)->limit(200)->paginate(10);

        $GunlukToplam = DB::table('odeme')
            ->where('created_at', Carbon::today())
            ->where('odeme_cevap', 1)
            ->sum('odeme.odeme_tutari');

        return view('dashboard::index', compact('UserCount', 'PersonelCount','OdemeListesi', 'GunlukToplam'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('dashboard::create');
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
        return view('dashboard::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('dashboard::edit');
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
}
