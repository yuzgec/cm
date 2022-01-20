<?php

namespace Modules\Profil\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Modules\Kullanici\Entities\Puantaj;
use Modules\Personel\Entities\PersonelBilgileri;

class ProfilController extends Controller
{
    public function index()
    {
        return view('profil::index');
    }
    public function show($id)
    {
        return view('profil::show');
    }
    public function edit()
    {
        $Personel = auth()->user();

        $MedeniHaller = [
            "0" => "Belirtilmemiş",
            "1" => "Evli",
            "2" => "Bekar",
            "3" => "Boşanmış"
        ];
        $Cinsiyetler = [
            "0" => "Belirtilmemiş",
            "1" => "Kadın",
            "2" => "Erkek",
            "3" => "Diğer"
        ];
        $EngelDereceleri = [
            "0" => "Yok",
            "1" => "1. Derece",
            "2" => "2. Derece",
            "3" => "3. Derece",
        ];
        $KanGruplari = [
            '0-', '0+', 'A-', 'A+', 'B-', 'B+', 'AB-', 'AB+',
        ];
        Carbon::setLocale('tr');
        foreach(CarbonPeriod::create('2021-01-01', '1 month', Carbon::now()->format('Y-m-d')) as $ay){
            $Aylar[] = ["id" => $ay->format('Ym'), "label" => $ay->translatedFormat('F Y')];
        }
        $Aylar = collect($Aylar)->sortByDesc('id')->toArray();
        $Ay = \request()->get('ay');
        if(!$Ay)
            $Ay = date('Ym01');
        else
            $Ay = $Ay."01";
        $TamTarih = Carbon::parse($Ay)->format('Y-m-d');

        $baslangic = $TamTarih;
        $bitis = Carbon::parse($TamTarih)->endOfMonth()->format('Y-m-d');
        $Kayitlar = $Personel->Puantaj()->where('gun','>=', $baslangic)->where('gun','<=', $bitis)->get();
        $Kayitlar = Puantaj::query()->where('user_id', $Personel->id)
            ->where('gun', '>=', $baslangic)
            ->where('gun','<=', $bitis)->get();
        $ToplamEksi = $Kayitlar->sum('gec_mesai');
        $FazlaMesai = $Kayitlar->sum('fazla_calisma');
        $MesaiAy = $Ay;

        return view('profil::edit', compact(
            'Personel','MedeniHaller','Cinsiyetler','EngelDereceleri','KanGruplari',
        ));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request)
    {
        $id = auth()->user()->id;
        $request->validate(
            [
                "name" => "required",
                "last_name" => "required",
                "tckn" => "required|numeric|digits:11",
                "email" => "required|email|unique:users,email,".$id,
                "telefon" => "required|numeric|digits:10"
            ],
            [
                "name.required" => "Lütfen personel adını belirtiniz",
                "last_name.required" => "Lütfen personel soyadınız belirtiniz",
                "tckn.required" => "Lütfen personel TC Kimlik Numarasını belirtiniz",
                "tckn.digits" => "TC Kimlik Numarası :digits karakter olmalıdır",
                "email.required" => "Giriş E-Posta adresi zorunludur",
                "email.email" => "Giriş E-Posta geçersiz",
                "email.unique" => "Giriş E-Posta zaten sistemde kayıtlıdır",
                "telefon.required" => "Lütfen telefon numarası belirtiniz",
                "telefon.numeric" => "Telefon numarası sadece rakam içermelidir",
                "telefon.digits" => "Telefon numarası :digits karakter olmalıdır.",
            ]
        );

        $data = $request->except('_token','password','_method','pb','diger');
        if($request->password){
            $data["password"] = Hash::make($request->password);
        }
        $User = User::findOrFail($id);
        $User->update($data);
        $Bilgiler = PersonelBilgileri::where('user_id', $id)->update($request->pb);

        return redirect()->back();
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
    public function mesailerim(){
        $Personel = auth()->user();
        Carbon::setLocale('tr');
        foreach(CarbonPeriod::create('2021-01-01', '1 month', Carbon::now()->format('Y-m-d')) as $ay){
            $Aylar[] = ["id" => $ay->format('Ym'), "label" => $ay->translatedFormat('F Y')];
        }
        $Aylar = collect($Aylar)->sortByDesc('id')->toArray();
        $Ay = \request()->get('ay');
        if(!$Ay)
            $Ay = date('Ym01');
        else
            $Ay = $Ay."01";
        $TamTarih = Carbon::parse($Ay)->format('Y-m-d');

        $baslangic = $TamTarih;
        $bitis = Carbon::parse($TamTarih)->endOfMonth()->format('Y-m-d');
        $Kayitlar = $Personel->Puantaj()->where('gun','>=', $baslangic)->where('gun','<=', $bitis)->get();
        $Kayitlar = Puantaj::query()->where('user_id', $Personel->id)
            ->where('gun', '>=', $baslangic)
            ->where('gun','<=', $bitis)->get();
        $ToplamEksi = $Kayitlar->sum('gec_mesai');
        $FazlaMesai = $Kayitlar->sum('fazla_calisma');
        $MesaiAy = $Ay;

        return view('profil::mesailer', compact('Kayitlar','ToplamEksi','FazlaMesai','Aylar','MesaiAy'));
    }
}
