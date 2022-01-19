<?php

namespace Modules\Dashboard\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Ayarlar\Entities\Departman;
use Modules\IK\Entities\Avans;
use Modules\IK\Entities\Izin;
use Modules\Odeme\Entities\Odeme;
use Modules\Personel\Entities\Personel;
use Modules\Personel\Entities\Puantaj;

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

        $Departmanlar = Departman::query()
            ->where('yonetici', auth()->user()->id)
            ->with('users.izinler')
            ->get();
        $Izinler = [];
        $Avanslar = [];
        foreach($Departmanlar as $Row){
            foreach ($Row->users as $user){
                foreach ($user->izinler as $izin){
                    if($izin->onaylar["Yetkili"] == 0)
                        $Izinler[] = $izin;
                }
                foreach ($user->avanslar as $avans){
                    if($avans->onaylar["Yetkili"] == 0)
                        $Avanslar[] = $avans;
                }
            }
        }
        if(auth()->user()->departman()->first()->name == "Muhasebe"){
            foreach (Izin::query()->where('durum',0)->where('onaylar->Muhasebe', 0)->where('onaylar->Yetkili',1)->get() as $Row){
                $Izinler[] = $Row;
            }
            foreach (Avans::query()->where('durum',0)->where('onaylar->Muhasebe', 0)->where('onaylar->Yetkili',1)->get() as $Row){
                $Avanslar[] = $Row;
            }
        }

        $Tarih = Carbon::now()->startOfMonth();
        $Izinlerim = Izin::query()->where('user_id', request()->user()->id)->whereDate('created_at', '>=', $Tarih->format('Y-m-d'))->get();
        $AvansTaleplerim = Avans::query()->where('user_id', request()->user()->id)->whereDate('created_at', '>=', $Tarih->format('Y-m-d'))->get();
        $FazlaMesai = Puantaj::query()
            ->select(DB::raw('user_id,SUM(fazla_calisma) AS mesai, SUM(gec_mesai) AS gec'))
            ->where('user_id', auth()->user()->id)
            ->whereYear('gun', Carbon::now()->format('Y'))
            ->whereMonth('gun', Carbon::now()->format('m'))
            ->groupBy('user_id')
            ->first();
        return view('dashboard::index', compact(
            'UserCount', 'PersonelCount','OdemeListesi', 'GunlukToplam',
            'Izinler','Avanslar','Izinlerim', 'AvansTaleplerim','FazlaMesai'
        ));
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
