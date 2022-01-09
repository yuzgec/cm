<?php

namespace Modules\Kullanici\Http\Controllers;

use App\Exports\MesaiRaporExport;
use App\Exports\PuantajExport;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Personel\Entities\Personel;
use Modules\Personel\Entities\Puantaj;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
Use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class KullaniciController extends Controller
{
    public function index()
    {
        if (request()->filled('q'))
        {
            request()->flash();
            $aranan = request('q');
            $Users = User::with('mesai')->with('roles')->where('name', 'like', "%$aranan%")
                ->orWhere('telefon','like', "%$aranan%")
                ->orderBy('id', 'DESC')
                ->paginate(40);

        } else {
            $Users = User::with('mesai')->with('roles')->paginate(40);
        }
        return view('kullanici::index',compact('Users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('kullanici::create',compact('roles'));
    }

    public function store(Request $request)
    {
        $user = new User;
        $user->name         =  $request->name;
        $user->email        =  $request->email;
        $user->telefon      =  $request->telefon;
        $user->durum        =  $request->durum;
        $user->depertman    =  $request->depertman;

        if ($request->password){
            $user->password     =  Hash::make($request->password);
        }

        $user->save();
        $user->addMedia($request->profil_foto)->toMediaCollection();
        $user->syncRoles($request->role);

        toast('eklendi.','success');
        return redirect()->route('kullanici.index');
    }

    public function show($id)
    {
        return view('kullanici::show');
    }

    public function edit($id)
    {
        $detay = User::findOrFail($id);
        $roles = Role::all();
        return view('kullanici::edit', compact('detay', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->name         =  $request->name;
        $user->email        =  $request->email;
        $user->telefon      =  $request->telefon;
        $user->durum        =  $request->durum;
        $user->depertman    =  $request->depertman;
        if ($request->password){
            $user->password     =  Hash::make($request->password);
        }
        $user->save();

        if ($request->hasFile('profil_foto')) {
            $user->media()->delete();
            $user->addMedia($request->profil_foto)->toMediaCollection();
        }

        $user->syncRoles($request->role);
        alert()->success('SuccessAlert','Lorem ipsum dolor sit amet.');

        return redirect()->route('kullanici.index');
    }

     public function destroy($id)
    {
        //
    }

    public function active(Request $request)
    {
        $update= User::findOrFail($request->id);
        $update->is_active = $request->is_active == "true" ? 1 : 0 ;
        $update->save();
    }


    public function giriscikis(){
        $Aylar = [];
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

        $personeller = \Illuminate\Support\Facades\DB::select('
            SELECT *,
                (
                    SELECT
                        SUM(personel_puantaj.fazla_calisma) as fazla_calisma
                    FROM personel_puantaj
                    WHERE user_id=users.id AND (gun BETWEEN "'.$baslangic.'" AND "'.$bitis.'")
                ) as fazla_mesai,
                (
                    SELECT
                        SUM(personel_puantaj.gec_mesai) as gec_mesai
                    FROM personel_puantaj
                    WHERE user_id=users.id AND (gun BETWEEN "'.$baslangic.'" AND "'.$bitis.'")
                ) as eksik_mesai

            FROM users');

        return view('kullanici::mesai.giriscikis', compact( 'personeller','Aylar'));
    }
    public function giriscikisdetay($user_id){
        $Personel = User::findOrFail($user_id);
        $Aylar = [];
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
        return view('kullanici::mesai.giriscikisdetay', compact('Personel', 'Aylar', 'Kayitlar'));
    }
    public function mesairaporlama(Request $request){

        $now = Carbon::now();
        if($request->tarih)
            $now = Carbon::parse($request->tarih);
        $HaftaBaslangic = $now->startOfWeek()->format('Y-m-d H:i');
        $HaftaBitis = $now->endOfWeek()->format('Y-m-d H:i');

        $MesaiRapor = Puantaj::with('getUser')->whereBetween('gun', [$HaftaBaslangic, $HaftaBitis])->get();

        $RaporTarih = Carbon::parse($HaftaBaslangic)->translatedFormat('d F Y').' - '.Carbon::parse($HaftaBitis)->translatedFormat('d F Y');
        $Gunler = ['Pazartesi', 'Salı', 'Çarşamba', 'Perşembe', 'Cuma', 'Cumartesi', 'Pazar'];
        $Personeller = [];
        foreach ($MesaiRapor as $Row){
            $Personeller[$Row->user_id][] = $Row;
        }
        return view('kullanici::mesai.raporlama', compact('MesaiRapor', 'RaporTarih', 'Gunler', 'Personeller', 'HaftaBaslangic'));
    }
    public function MesaiRaporExcelIndir(Request $request){

        $RaporTarih = Carbon::yesterday()->toDateString();
        $now = Carbon::now();
        if($request->tarih)
            $now = Carbon::parse($request->tarih);
        $HaftaBaslangic = $now->startOfWeek()->format('Y-m-d H:i');
        $HaftaBitis = $now->endOfWeek()->format('Y-m-d H:i');


        $MesaiRapor = Puantaj::with('getUser')->whereBetween('gun', [$HaftaBaslangic, $HaftaBitis])->get();

        $data = [];
        $data[] =  ['Personel ID', 'Pazartesi', 'Salı', 'Çarşamba', 'Perşembe', 'Cuma', 'Cumartesi', 'Pazar'];

        foreach ($MesaiRapor as $Row){
            $data[] = $Row->getUser->adsoyad;
            for ($i=0; $i >= 6;$i++){
                $data[] = $Row->fazla_calisma;
                $data[] = $Row->gec_mesai;
                $data[] = substr($Row->mesai_giris, -8);
                $data[] = substr($Row->mesai_cikis, -8);
            }
        }

        $data = new MesaiRaporExport($data);
        return Excel::download($data, $RaporTarih.' Mesai Rapor.xlsx');
    }
    public function ExcelIndir(Request $request){
        $Puantaj = Puantaj::query();
        $Ay = date('Ym01');
        if($request->ay)
            $Ay = $request->ay."01";

        $TamTarih = Carbon::parse($Ay)->format('Y-m-d');

        $baslangic = $TamTarih;
        $bitis = Carbon::parse($TamTarih)->endOfMonth()->format('Y-m-d');
        $personeller = DB::select('
            SELECT *,
                (
                    SELECT
                        SUM(personel_puantaj.fazla_calisma) as fazla_calisma
                    FROM personel_puantaj
                    WHERE user_id=personel.id AND (gun BETWEEN "'.$baslangic.'" AND "'.$bitis.'")
                ) as fazla_mesai,
                (
                    SELECT
                        SUM(personel_puantaj.gec_mesai) as gec_mesai
                    FROM personel_puantaj
                    WHERE user_id=personel.id AND (gun BETWEEN "'.$baslangic.'" AND "'.$bitis.'")
                ) as eksik_mesai

            FROM users');
        $data = [];
        $data[] = [
            "Puantaj Periyodu",
            "Personel Adı Soyadı",
            "Fazla Çalışma (Dakika)",
            "Eksik Çalışma (Dakika)"
        ];
        foreach ($personeller as $row){
            $data[] = [
                Carbon::parse($TamTarih)->locale('tr')->translatedFormat('Y F'). " Puantajı",
                $row->adsoyad,
                $row->fazla_mesai,
                $row->eksik_mesai
            ];
        }
        $data = new PuantajExport($data);
        return Excel::download($data, 'Puantaj.xlsx');
    }
    public function ExcelDetayIndir(Request $request){
        $Personel = User::findOrFail($request->personel);
        $Ay = date('Ym01');
        if($request->ay)
            $Ay = $request->ay."01";

        $TamTarih = Carbon::parse($Ay)->format('Y-m-d');

        $baslangic = $TamTarih;
        $bitis = Carbon::parse($TamTarih)->endOfMonth()->format('Y-m-d');
        $data = [];
        $data[] = ["Tarih","Mesai Giriş Saati","Geç Giriş","Mesai Çıkış Saait","Fazla Mesai"];
        $Kayitlar = Puantaj::query()->where('user_id', $Personel->id)
            ->where('gun', '>=', $baslangic)
            ->where('gun','<=', $bitis)->get();
        foreach ($Kayitlar as $row){
            $data[] = [
                Carbon::parse($row->gun)->locale('tr')->translatedFormat('d F Y l'),
                $row->mesai_giris->format('H:i'),
                (($row->gec_mesai > 0)?$row->gec_mesai:0),
                $row->mesai_cikis->format('H:i'),
                (($row->fazla_calisma>0)?$row->fazla_calisma:0)
            ];
        }
        $data = new PuantajExport($data);
        return Excel::download($data, 'Puantaj Detay.xlsx');
    }
}
