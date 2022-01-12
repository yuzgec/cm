<?php

namespace Modules\Ayarlar\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Ayarlar\Entities\Departman;
use Modules\Ayarlar\Entities\Sube;
use Modules\Ayarlar\Entities\Unvan;

class AyarlarController extends Controller
{
    public function index()
    {
        return view('ayarlar::index');
    }
    public function getSirket(){
        $Subeler = Sube::with('Yetkili')->get();
        $Departmanlar = Departman::with('Yetkili','Sube')->get();
        $Unvanlar = Unvan::with('Yetkili','Departman')->get();
        $Calisanlar = User::select('id','name')->get();
        return response()->json([
            "Subeler" => $Subeler,
            "Departmanlar" => $Departmanlar,
            "Unvanlar" => $Unvanlar,
            "Calisanlar" => $Calisanlar
        ]);
    }
    public function storeSube(Request $request){
        $request->validate(["name" => "required"],["name.required" => "Şube adı zorunludur"]);
        if($request->id > 0)
            $Item = Sube::findOrFail($request->id);
        else
            $Item = new Sube();
        $Item->name = $request->name;
        $Item->yonetici = $request->yetkili ? $request->yetkili : null;
        $Item->save();
        return response()->json(["Subeler" => Sube::with('Yetkili')->get()]);
    }
    public function storeDepartman(Request $request){
        $request->validate(["name" => "required"],["name.required" => "Departman adı zorunludur"]);
        if($request->id > 0)
            $Item = Departman::findOrFail($request->id);
        else
            $Item = new Departman();
        $Item->name = $request->name;
        $Item->yonetici = $request->yetkili ? $request->yetkili : null;
        $Item->sube_id = $request->sube_id ? $request->sube_id : null;
        $Item->mesai_baslangic = $request->mesai_baslangic ? $request->mesai_baslangic : null;
        $Item->mesai_bitis = $request->mesai_bitis ? $request->mesai_bitis : null;
        $Item->renk = $request->renk;
        $Item->save();
        return response()->json(["Departmanlar" => Departman::with('Yetkili','Sube')->get()]);
    }
    public function storeUnvan(Request $request){
        $request->validate(["name" => "required"],["name.required" => "Departman adı zorunludur"]);
        if($request->id > 0)
            $Item = Unvan::findOrFail($request->id);
        else
            $Item = new Unvan();
        $Item->name = $request->name;
        $Item->yonetici = $request->yetkili ? $request->yetkili : null;
        $Item->departman_id = $request->departman_id ? $request->departman_id : null;
        $Item->save();
        return response()->json(["Unvanlar" => Unvan::with('Yetkili','Departman')->get()]);
    }
}
