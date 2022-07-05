<?php

namespace Modules\IK\Http\Controllers;

use App\Exports\IzinExport;
use App\Exports\OzlukExport;
use App\Helpers\IzinHesap;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Ayarlar\Entities\Departman;
use Modules\Ayarlar\Entities\Sube;
use Modules\Ayarlar\Entities\Tatil;
use Modules\IK\Emails\IzinTalep;
use Modules\IK\Entities\Avans;
use Modules\IK\Entities\Izin;
use Modules\IK\Jobs\IzinTalepEMailJob;
use Modules\Kullanici\Entities\Puantaj;
use Modules\Personel\Entities\Mesai;
use Modules\Personel\Entities\Personel;
use Modules\Personel\Entities\PersonelBilgileri;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Spatie\Permission\Models\Role;

class IKController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $Personel = Personel::all();
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
        return view('ik::index', compact(
            'Personel',
            'Izinler',
            'Avanslar'
        ));
    }
    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $Roles = Role::query()->get()->pluck('name','id');
        $Roles[0] = "Seçiniz";
        $Roles = $Roles->sortKeys();
        $Departmanlar = Departman::query()->get()->pluck('name','id');
        $Departmanlar[0] = "Seçiniz";
        $Departmanlar = $Departmanlar->sortKeys();
        $Subeler = Sube::query()->get()->pluck('name','id');
        $Subeler[0] = "Seçiniz";
        $Subeler = $Subeler->sortKeys();
        return view('ik::create',compact(
            'Roles',
            'Departmanlar',
            'Subeler'
        ));
    }
    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {

        $request->validate(
            [
                "name" => "required",
                "last_name" => "required",
                "tckn" => "required|numeric|digits:11",
                "email" => "required|email|unique:users,email",
                "password" => "required|min:5",
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
                "password.required" => "Lütfen giriş şifresini belirtiniz",
                "password.min" => "Şifre en az :min karakter olmalıdır",
                "telefon.required" => "Lütfen telefon numarası belirtiniz",
                "telefon.numeric" => "Telefon numarası sadece rakam içermelidir",
                "telefon.digits" => "Telefon numarası :digits karakter olmalıdır.",
            ]
        );
        $data = $request->except('_token','pb','diger');
        $data["password"] = Hash::make($data["password"]);
        $User = User::query()->create($data);
        if($request->diger["role"]){
            $Role = Role::findById($request->diger["role"]);
            $User->assignRole($Role);
        }
        if($request->diger["departman"]){
            $Departman = Departman::findOrFail($request->diger["departman"]);
            $User->departman()->sync($Departman, false);
        }
        if($request->diger["sube"]){
            $Sube = Sube::findOrFail($request->diger["sube"]);
            $User->sube()->sync($Sube, false);
        }
        $pb = $request->pb;
        $PB = new PersonelBilgileri();
        $PB->user_id = $User->id;
        $PB->kisisel_telefon = $pb["kisisel_telefon"];
        $PB->ise_baslama_tarihi = $pb["ise_baslama_tarihi"];
        $PB->sozlesme_turu = $pb["sozlesme_turu"];
        $PB->save();
        return redirect(route('IK.calisanlar'));
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
        $Personel = User::with('bilgiler')->findOrFail($id);
        $Roles = Role::query()->get()->pluck('name','id');
        $Roles[0] = "Seçiniz";
        $Roles = $Roles->sortKeys();
        $Departmanlar = Departman::query()->get()->pluck('name','id');
        $Departmanlar[0] = "Seçiniz";
        $Departmanlar = $Departmanlar->sortKeys();
        $Subeler = Sube::query()->get()->pluck('name','id');
        $Subeler[0] = "Seçiniz";
        $Subeler = $Subeler->sortKeys();
        $Personel->pb = $Personel->bilgiler;
        $Personel->diger = [
            "role" => $Personel->roles()->count() ? $Personel->roles()->first()->id: null,
            "sube" => $Personel->sube()->count() ? $Personel->sube()->first()->id: null,
            "departman" => $Personel->departman()->count() ? $Personel->departman()->first()->id: null,
        ];
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
//        dd($ToplamEksi);
        return view('ik::edit',compact(
            'Personel',
            'Roles',
            'Departmanlar',
            'Subeler',
            'MedeniHaller',
            'Cinsiyetler',
            'EngelDereceleri',
            'KanGruplari',
            'Aylar',
            'Kayitlar',
            'MesaiAy',
            'ToplamEksi',
            'FazlaMesai'
        ));
    }
    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
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
        $pb = $request->pb;
        $Bilgiler = PersonelBilgileri::where('user_id', $id)->get();
        if($Bilgiler->count()<1){
            PersonelBilgileri::query()->insert([
                "user_id" => $User->id
            ]);
        }
        $Bilgiler = PersonelBilgileri::where('user_id', $id)->first();
        foreach ($pb as $index => $value){
            $Bilgiler->$index = $value;
        }
        $Bilgiler->save();
        if($request->diger["role"]){
            $Role = Role::findById($request->diger["role"]);
            $User->assignRole($Role);
        }
        if($request->diger["departman"]){
            $Departman = Departman::findOrFail($request->diger["departman"]);
            $User->departman()->sync($Departman, true);
        }
        if($request->diger["sube"]){
            $Sube = Sube::findOrFail($request->diger["sube"]);
            $User->sube()->sync($Sube, true);
        }
        return redirect(route('IK.calisanlar'));
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
        $Users = User::query();
        if(\request()->get('q'))
            $Users->where('name', 'like' , '%'. request()->get('q') .'%')
                ->orWhere('last_name', 'like', '%'. request()->get('q') .'%');

        $Users = $Users->orderBy('name')->paginate(20);
        //dd($Personel);

        return view('ik::calisanlar', compact('Users'));
    }
    public function pasifcalisanlar(){
        $Users = User::query()->withoutGlobalScopes()->where('durum','=',0);
        if(\request()->get('q'))
            $Users->where('name', 'like' , '%'. request()->get('q') .'%')
                ->orWhere('last_name', 'like', '%'. request()->get('q') .'%');

        $Users = $Users->orderBy('name')->paginate(20);

        return view('ik::calisanlar', compact('Users'));
    }
    public function calisanDetay($id){
        $PersoneDetay = Personel::find($id);
        return view('ik::calisandetay', compact('PersoneDetay'));
    }
    public function izinler(){
        $Personel = Personel::with('mesai')->paginate(5);
        $YaklasanIzinler = [];
        $OnayBekleyenler = [];
        $Onaylananlar = [];
        $Reddedilenler = [];
        $Departmanlar = Departman::query()
            ->where('yonetici', auth()->user()->id)
            ->with('users.izinler')
            ->get();
        foreach ($Departmanlar as $Row){
            foreach ($Row->users as $user){
                foreach ($user->izinler as $izin){
                    if($izin->durum == 0)
                        $OnayBekleyenler[] = $izin;
                    if($izin->durum == -1)
                        $Reddedilenler[] = $izin;
                    if($izin->durum == 1)
                        $Onaylananlar[] = $izin;
                }
            }
        }
        return view('ik::izinler', compact(
            'Personel',
            'YaklasanIzinler',
            'OnayBekleyenler',
            'Onaylananlar',
            'Reddedilenler'
        ));
    }
    public function IzinTalep(Request $request){
        $Talep = $request->izinTalep;

        $Time = new \Carbon\Carbon($Talep["baslangic_tarihi"]." " . $Talep["baslangic_saati"]);
        $End = new \Carbon\Carbon($Talep["bitis_tarihi"]." " . $Talep["bitis_saati"]);

        $Fark = IzinHesap::IzinHesapla(auth()->user()->id, $Time, $End, $Talep["tur"]);

//        $Fark = $Time->diffInHours($End);
//        $MesaiBaslangic = new Carbon(auth()->user()->departman()->first()->mesai_baslangic);
//        $MesaiBitis = new Carbon(auth()->user()->departman()->first()->mesai_bitis);
//        $MesaiSaat = $MesaiBitis->diffInHours($MesaiBaslangic);
//        if($Fark < $MesaiSaat){
//            $Fark = $Fark / $MesaiSaat;
//            if($Fark > 0.9)
//                $Fark = 1;
//        }else{
//            $Fark = $Time->diffInDays($End);
//            $Fark = $Fark < 1 ? 1: $Fark;
//        }
//
//        if($Talep["tur"] == 1){
//            $Baslangic = new Carbon(Carbon::parse($Talep["baslangic_tarihi"])->format('Y-m-d 00:00:01'));
//            $Bitis = new Carbon(Carbon::parse($Talep["bitis_tarihi"])->format('Y-m-d 23:59:59'));
//            $Tatiller = Tatil::query()->whereBetween('baslangic', [$Baslangic, $Bitis])->get();
//            $Fark = $Baslangic->diffInDaysFiltered(function (Carbon $date) use ($Tatiller){
//                return !$date->isSunday() && !$this->checkHoliday($date->format('Y-m-d'));
//            }, $Bitis);
//        }
//
        $baslangic = Carbon::parse($Talep["baslangic_tarihi"]." " . $Talep["baslangic_saati"]);
        $bitis = Carbon::parse($Talep["bitis_tarihi"]." " . $Talep["bitis_saati"]);
        $gun = $Fark;


        $Izin = new Izin();
        $Izin->user_id = auth()->user()->id;
        $Izin->tur = $Talep["tur"];
        $Izin->baslangic = $baslangic;
        $Izin->bitis = $bitis;
        $Izin->aciklama = $Talep["aciklama"];
        $Izin->yerine_bakacak = $Talep["yerine_bakacak"];
        $Izin->donus = Carbon::parse($Talep["donus_tarihi"]." " . $Talep["donus_saati"])->format('Y-m-d H:i:s');
        $Izin->durum = 0;
        $Izin->gun = $gun;
        $Izin->onaylar = [
            "Yetkili" => 0,
            "Muhasebe" => 0,
            "YetkiliMessage" => "",
            "MuhasebeMessage" => "",
        ];
        $Izin->save();
        $Yetkili = $request->user()->departman()->first()->yetkili->email;
        $Mesaj = "Merhaba, {$Izin->user->full_name},<br>İzin talebiniz başarıyla oluşturulmuştur.";
        $IzinTalepFormu = storage_path("app/tmp/" . $this->IzinTalepFormuOlustur($Izin->id));
        dispatch(new IzinTalepEMailJob($Izin,$Izin->user->email, $Mesaj, $IzinTalepFormu));

        $Mesaj = "Merhaba<br> <strong>{$Izin->user->full_name}</strong> İzin talebinde bulunmuştur ve onayınızı beklemektedir.";
        dispatch(new IzinTalepEMailJob($Izin,$Yetkili, $Mesaj));

        return response()->json(["Success" => true]);
    }
    public function izinDetay($id){
        $Izin = Izin::findOrFail($id);
        return view('ik::izinDetay', compact('Izin'));
    }
    public function IzinOnayla(Request $request){
        $tip = $request->tip;
        $id = $request->id;
        $Izin = Izin::findOrFail($id);
        $Onay = $Izin->onaylar;
        switch ($tip){
            case "Yetkili":
                if($Izin->user->departman()->first()->yetkili->id != auth()->user()->id)
                    return response()->json(["Success" => false, "Message" => "Bu kullanıcının yönetici değilsiniz"], 406);
                if($Izin->onaylar["Yetkili"] != 0)
                    return response()->json(["Success" => false, "Message" => "Bu talep için zaten işlem yapılmış"], 406);


                $Onay["Yetkili"] = 1;
                $Onay["YetkiliTarih"] = Carbon::now()->format('Y-m-d H:i:s');
                $Izin->onaylar = $Onay;
                $Izin->save();
                $Mesaj = "Merhaba<br> <strong>{$Izin->user->full_name}</strong> İzin talebinde bulunmuştur. Yetkili onayından geçmiş ve tarafınızadan onay beklemektedir.";
                dispatch(new IzinTalepEMailJob($Izin, 'ekrem@baro.com.tr', $Mesaj));
                break;
            case "Muhasebe":
                if(auth()->user()->departman()->first()->name != "Muhasebe")
                    return response()->json(["Success" => false, "Message" => "Muhasebe departmanına dahil değilsiniz"], 406);
                if($Izin->onaylar["Muhasebe"] != 0)
                    return response()->json(["Success" => false, "Message" => "Bu talep için zaten işlem yapılmış"], 406);
                $Onay["Muhasebe"] = 1;
                $Onay["MuhasebeTarih"] = Carbon::now()->format('Y-m-d H:i:s');
                $Onay["MuhasebeUser"] = auth()->user()->id;
                $Izin->onaylar = $Onay;
                $Izin->durum = 1;
                $Izin->save();
                break;
        }
    }
    public function IzinReddet(Request $request){
        $tip = $request->tip;
        $id = $request->id;
        $mesaj = $request->message;
        $Izin = Izin::findOrFail($id);
        $Onay = $Izin->onaylar;
        switch ($tip){
            case "Yetkili":
                if($Izin->user->departman()->first()->yetkili->id != auth()->user()->id)
                    return response()->json(["Success" => false, "Message" => "Bu kullanıcının yönetici değilsiniz"], 406);
                if($Izin->onaylar["Yetkili"] != 0)
                    return response()->json(["Success" => false, "Message" => "Bu talep için zaten işlem yapılmış"], 406);

                $Onay["Yetkili"] = -1;
                $Onay["YetkiliMessage"] = $mesaj;
                $Onay["YetkiliTarih"] = Carbon::now()->format('Y-m-d H:i:s');
                $Izin->onaylar = $Onay;
                $Izin->durum = -1;
                $Izin->save();
                break;
            case "Muhasebe":
                if(auth()->user()->departman()->first()->name != "Muhasebe")
                    return response()->json(["Success" => false, "Message" => "Muhasebe departmanına dahil değilsiniz"], 406);
                if($Izin->onaylar["Muhasebe"] != 0)
                    return response()->json(["Success" => false, "Message" => "Bu talep için zaten işlem yapılmış"], 406);
                $Onay["Muhasebe"] = -1;
                $Onay["MuhasebeTarih"] = Carbon::now()->format('Y-m-d H:i:s');
                $Onay["MuhasebeUser"] = auth()->user()->id;
                $Onay["MuhasebeMessage"] = $mesaj;
                $Izin->onaylar = $Onay;
                $Izin->durum = -1;
                $Izin->save();
                break;
        }
    }
    public function AvansTalep(Request $request){
        $Talep = $request->avansTalep;
        $request->validate([
            "avansTalep.tarih" => "required",
            "avansTalep.tutar" => "required",
            "avansTalep.aciklama" => "required"
        ], [
            "avansTalep.tarih.required" => "Lütfen avans için tarih belirtin",
            "avansTalep.tutar.required" => "Lütfen avans tutarını belirtin",
            "avansTalep.aciklama.required" => "Lütfen avans için açıklama belirtin"
        ]);

        $Avans = new Avans();
        $Avans->user_id = auth()->user()->id;
        $Avans->tutar = $Talep["tutar"];
        $Avans->tarih = $Talep["tarih"];
        $Avans->aciklama = $Talep["aciklama"];
        $Avans->durum  = 0;
        $Yetkili = '';
        $Avans->onaylar = [
            "Yetkili" => 1,
            "YetkiliTarih" => Carbon::now()->format('Y-m-d H:i:s'),
            "Muhasebe" => 0,
            "YetkiliMessage" => "",
            "MuhasebeMessage" => "",
        ];
        $Avans->save();
        return response()->json(["Success" => true]);
    }
    public function avansDetay($id){
        $Avans = Avans::findOrFail($id);
        return view('ik::avansDetay', compact('Avans'));
    }
    public function AvansOnayla(Request $request){
        $tip = $request->tip;
        $id = $request->id;
        $Avans = Avans::findOrFail($id);
        $Onay = $Avans->onaylar;
        switch ($tip){
            case "Yetkili":
                if($Avans->user->departman()->first()->yetkili->id != auth()->user()->id)
                    return response()->json(["Success" => false, "Message" => "Bu kullanıcının yönetici değilsiniz"], 406);
                if($Avans->onaylar["Yetkili"] != 0)
                    return response()->json(["Success" => false, "Message" => "Bu talep için zaten işlem yapılmış"], 406);


                $Onay["Yetkili"] = 1;
                $Onay["YetkiliTarih"] = Carbon::now()->format('Y-m-d H:i:s');
                $Avans->onaylar = $Onay;
                $Avans->save();
                break;
            case "Muhasebe":
                if(auth()->user()->departman()->first()->name != "Muhasebe")
                    return response()->json(["Success" => false, "Message" => "Muhasebe departmanına dahil değilsiniz"], 406);
                if($Avans->onaylar["Muhasebe"] != 0)
                    return response()->json(["Success" => false, "Message" => "Bu talep için zaten işlem yapılmış"], 406);
                $Onay["Muhasebe"] = 1;
                $Onay["MuhasebeTarih"] = Carbon::now()->format('Y-m-d H:i:s');
                $Onay["MuhasebeUser"] = auth()->user()->id;
                $Avans->onaylar = $Onay;
                $Avans->durum = 1;
                $Avans->save();
                break;
        }
    }
    public function AvansReddet(Request $request){
        $tip = $request->tip;
        $id = $request->id;
        $mesaj = $request->message;
        $Avans = Avans::findOrFail($id);
        $Onay = $Avans->onaylar;
        switch ($tip){
            case "Yetkili":
                if($Avans->user->departman()->first()->yetkili->id != auth()->user()->id)
                    return response()->json(["Success" => false, "Message" => "Bu kullanıcının yönetici değilsiniz"], 406);
                if($Avans->onaylar["Yetkili"] != 0)
                    return response()->json(["Success" => false, "Message" => "Bu talep için zaten işlem yapılmış"], 406);

                $Onay["Yetkili"] = -1;
                $Onay["YetkiliMessage"] = $mesaj;
                $Onay["YetkiliTarih"] = Carbon::now()->format('Y-m-d H:i:s');
                $Avans->onaylar = $Onay;
                $Avans->durum = -1;
                $Avans->save();
                break;
            case "Muhasebe":
                if(auth()->user()->departman()->first()->name != "Muhasebe")
                    return response()->json(["Success" => false, "Message" => "Muhasebe departmanına dahil değilsiniz"], 406);
                if($Avans->onaylar["Muhasebe"] != 0)
                    return response()->json(["Success" => false, "Message" => "Bu talep için zaten işlem yapılmış"], 406);
                $Onay["Muhasebe"] = -1;
                $Onay["MuhasebeTarih"] = Carbon::now()->format('Y-m-d H:i:s');
                $Onay["MuhasebeUser"] = auth()->user()->id;
                $Onay["MuhasebeMessage"] = $mesaj;
                $Avans->onaylar = $Onay;
                $Avans->durum = -1;
                $Avans->save();
                break;
        }
    }
    public function Raporlar(Request $request){
        $now = Carbon::now();
        if($request->tarih)
            $now = Carbon::parse($request->tarih);
        $HaftaBaslangic = $now->startOfWeek()->format('Y-m-d H:i');
        $HaftaBitis = $now->endOfWeek()->format('Y-m-d H:i');

        $MesaiRapor = Puantaj::with('user')
            ->whereBetween('gun', [$HaftaBaslangic, $HaftaBitis])
            ->has('user')
            ->get();

        $Period = CarbonPeriod::create($now->startOfWeek()->format('Y-m-d'), $now->endOfWeek()->format('Y-m-d'));

        $RaporTarih = Carbon::parse($HaftaBaslangic)->translatedFormat('d F Y').' - '.Carbon::parse($HaftaBitis)->translatedFormat('d F Y');
        $Gunler = ['Pazartesi', 'Salı', 'Çarşamba', 'Perşembe', 'Cuma', 'Cumartesi', 'Pazar'];
        $Personeller = [];


        $Kullanicilar = [];
        $Users = User::query()->whereNotNull('remote_id')->get();
        foreach ($Users as $row){
            $Kullanicilar[$row->full_name] = $row->puantaj()->whereBetween('gun', [$HaftaBaslangic, $HaftaBitis])->get();
        }


        $KalanIzinler = [];
        foreach (User::all() as $user){
            $IzinHakedis = $user->izin_hakedis;
            $Kullanilan = $user->izinler()->where('tur',1)->where('durum', 1)->sum('gun');
             $BuYil = Carbon::now()->firstOfYear();
//            $kullanilan = $user->izinler()->where('tur',1)->whereYear('baslangic', $BuYil->year)->where('durum',1)->sum('gun');
            $kalan = $IzinHakedis - $Kullanilan;
            $user->kalan_izin = $kalan;
            $user->kullanilan = $Kullanilan;
            $KalanIzinler[] = $user;
        }
        $Personel = Personel::with('mesai')->paginate(5);
        $YaklasanIzinler = [];
        $OnayBekleyenler = [];
        $Onaylananlar = [];
        $Reddedilenler = [];
        $IzinBaslangic = $request->get('IzinBaslangic') ? $request->get('IzinBaslangic') : Carbon::now()->subDays(7);
        $IzinBitis = $request->get('IzinBitis') ? $request->get('IzinBitis') : Carbon::now();
        if(auth()->user()->departman()->first()->name == "Muhasebe"){
            foreach (User::all() as $user){
                foreach ($user->izinler()->whereBetween('baslangic', [Carbon::parse($IzinBaslangic)->format('Y-m-d'), Carbon::parse($IzinBitis)->format('Y-m-d')])->get() as $izin){
                    if($izin->durum == 0)
                        $OnayBekleyenler[] = $izin;
                    if($izin->durum == -1)
                        $Reddedilenler[] = $izin;
                    if($izin->durum == 1)
                        $Onaylananlar[] = $izin;
                }
            }
        }else{
            $Departmanlar = Departman::query()
                ->where('yonetici', auth()->user()->id)
                ->with('users.izinler')
                ->get();
            foreach ($Departmanlar as $Row){
                foreach ($Row->users as $user){
                    foreach ($user->izinler as $izin){
                        if($izin->durum == 0)
                            $OnayBekleyenler[] = $izin;
                        if($izin->durum == -1)
                            $Reddedilenler[] = $izin;
                        if($izin->durum == 1)
                            $Onaylananlar[] = $izin;
                    }
                }
            }
        }
        $Onaylananlar = collect($Onaylananlar)->sortByDesc('baslangic');
        $OnayBekleyenler = collect($OnayBekleyenler)->sortByDesc('baslangic');
        $Reddedilenler = collect($Reddedilenler)->sortByDesc('baslangic');
        $Avanslar = Avans::query()->get();

        return view('ik::raporlar', compact(
            'Gunler',
            'Personeller',
            'RaporTarih',
            'HaftaBaslangic',
            'HaftaBitis',
            'Personel',
            'YaklasanIzinler',
            'OnayBekleyenler',
            'Onaylananlar',
            'Reddedilenler',
            'Avanslar',
            'KalanIzinler',
            'IzinBitis',
            'IzinBaslangic',
            'Kullanicilar',
            'Period'
        ));
    }
    public function IzinTalepEt(){
        return view('Modals.IzinTalep');
    }
    public function IzinEkle($id){
        $Personel = User::findOrFail($id);
        return view('Modals.IzinEkle', compact('Personel'));
    }
    public function IzinOlustur(Request $request){
        $data = $request->izinTalep;


        $Time = new \Carbon\Carbon($data["baslangic_tarihi"]." " . $data["baslangic_saati"]);
        $End = new \Carbon\Carbon($data["bitis_tarihi"]." " . $data["bitis_saati"]);

        $Fark = IzinHesap::IzinHesapla($data["user_id"], $Time, $End, $data["tur"]);

//        $Fark = $Time->diffInHours($End);
//        $MesaiBaslangic = new Carbon(auth()->user()->departman()->first()->mesai_baslangic);
//        $MesaiBitis = new Carbon(auth()->user()->departman()->first()->mesai_bitis);
//        $MesaiSaat = $MesaiBitis->diffInHours($MesaiBaslangic);
//        if($Fark < $MesaiSaat){
//            $Fark = $Fark / $MesaiSaat;
//            if($Fark > 0.9)
//                $Fark = 1;
//        }else{
//            $Fark = $Time->diffInDays($End);
//            $Fark = $Fark < 1 ? 1: $Fark;
//        }


        $baslangic = Carbon::parse($data["baslangic_tarihi"]." " . $data["baslangic_saati"]);
        $bitis = Carbon::parse($data["bitis_tarihi"]." " . $data["bitis_saati"]);
        $gun = $Fark;

        $Onay = [
            "Muhasebe" => 1,
            "Yetkili" => 1,
            "YetkiliTarih" => Carbon::now()->format('Y-m-d H:i:s'),
            "MuhasebeTarih" => Carbon::now()->format('Y-m-d H:i:s'),
            "MuhasebeUser" => \auth()->user()->id
        ];

        $Izin = new Izin();
        $Izin->user_id = $request->user_id;
        $Izin->tur = $data["tur"];
        $Izin->baslangic = $baslangic;
        $Izin->bitis = $bitis;
        $Izin->aciklama = $data["aciklama"];
        $Izin->yerine_bakacak = $data["yerine_bakacak"];
        $Izin->donus = Carbon::parse($data["donus_tarihi"]." " . $data["donus_saati"])->format('Y-m-d H:i:s');
        $Izin->durum = 1;
        $Izin->gun = $gun;
        $Izin->onaylar = $Onay;
        $Izin->save();
        return response()->json(["Success" => true]);
    }
    public function MesaiTarihAralihi(Request $request){
        $baslangic = $request->baslangic ? Carbon::parse($request->baslangic)->format('Y-m-d') : Carbon::now()->subDays(7)->format('Y-m-d');
        $bitis = $request->bitis ? Carbon::parse($request->bitis)->format('Y-m-d') : Carbon::now()->format('Y-m-d');

        $Puantaj = Puantaj::query()
            ->with('user')
            ->whereBetween('gun', [$baslangic, $bitis])
            ->orderBy('user_id')
            ->orderBy('gun');
        if($request->kullanici > 0)
            $Puantaj->where('user_id', $request->kullanici);
        $Puantaj = $Puantaj->get();

        return response()->json(['Liste' => $Puantaj]);
    }
    public function IzinTalepFormu($id){
        $name = $this->IzinTalepFormuOlustur($id);
        return Response::download(storage_path('app/tmp/'.$name), "IzinTalepFormu.xlsx");
    }
    public function IzinMutabakat(){
        $User = \auth()->user();
        $IsBasi = $User->bilgiler->ise_baslama_tarihi;
        if(!$IsBasi)
            dd('İşe başlama tarihi belirtilmemiş');

        $BuYil = Carbon::parse(Carbon::now()->format('Y-').$IsBasi->format("m-d"))->subYear();

        $kullanilan = \auth()->user()->izinler()->where('tur',1)->whereDate('baslangic', '>=', $BuYil->format('Y-m-d'))->where('durum',1)->get();
        $KullanilanToplam = $kullanilan->sum('gun');
        $fileName = storage_path('app/IzinMutabakat.xlsx');
        $SS = IOFactory::load($fileName);
        $SS->setActiveSheetIndex(0);
        $SS->getActiveSheet()->setCellValue('A3','Ad Soyadı : ' . \auth()->user()->full_name);
        $SS->getActiveSheet()->setCellValue('C3','T.C. Kimlik : ' . \auth()->user()->tckn);
        $SS->getActiveSheet()->setCellValue('F3','İşe Giriş Tarihi : ' . $IsBasi->format('d.m.Y'));
        $SS->getActiveSheet()->setCellValue('A4','Birim : ' . \auth()->user()->departman()->first()->name);

        $SS->getActiveSheet()->setCellValue('A9','Devir Gelen : 0 gün');
        $SS->getActiveSheet()->setCellValue('C9','Bu Yıl Kazanılan :' . \auth()->user()->izin_hakki . 'gün');
        $SS->getActiveSheet()->setCellValue('F9','Bu Yıl Kullanılan :' . $KullanilanToplam. 'gün');

        $SS->getActiveSheet()->setCellValue('A10','Toplam : '.\auth()->user()->izin_hakki.' gün');
        $SS->getActiveSheet()->setCellValue('C10','Bu Yıl Kazanılan :' . $KullanilanToplam . 'gün');
        $SS->getActiveSheet()->setCellValue('F10','Bu Yıl Kullanılan :' . (\auth()->user()->izin_hakki - $KullanilanToplam). 'gün');

        $SS->getActiveSheet()->setCellValue('A15', $BuYil->format('d.m.Y') . ' ile ' . Carbon::now()->format('d.m.Y') . ' Tarihleri Arasında Kullandığım İzinler');


        $SS->getActiveSheet()->setCellValue('A36', 'Yukarıda belirtilen kalan izin günümün doğru olduğunu ve listede yer alan tüm izinleri kullandığımı kabul ve taahhüt ediyorum');
        $SS->getActiveSheet()->setCellValue('A39', 'Ad Soyad');
        $SS->getActiveSheet()->setCellValue('A42', 'İmza');
        $SS->getActiveSheet()->setCellValue('E40', Carbon::now()->locale('tr')->translatedFormat('d F Y'));

        $satir = 17;
        foreach ($kullanilan as $row){
            $SS->getActiveSheet()->setCellValue('A'.$satir, $row->baslangic->format('d.m.Y'));
            $SS->getActiveSheet()->setCellValue('C'.$satir, $row->bitis->format('d.m.Y'));
            $SS->getActiveSheet()->setCellValue('E'.$satir, 'Yıllık İzin');
            $SS->getActiveSheet()->setCellValue('G'.$satir, $row->gun);

            $satir++;
        }

        $writer = new Xlsx($SS);
        if(!File::exists(storage_path('app/tmp')))
            File::makeDirectory(storage_path('app/tmp'));
        $name = Str::uuid().".xlsx";
        $writer->save(storage_path('app/tmp/'.$name));
        return Response::download(storage_path('app/tmp/'.$name), 'İzin Mutabakat Formu - ' . $User->full_name.'.xlsx');
    }
    public function IzinHesapla(Request $request){
        $Time = new \Carbon\Carbon($request->baslangic);
        $End = new \Carbon\Carbon($request->bitis);

        $Fark = IzinHesap::IzinHesapla(\auth()->user()->id, $Time, $End, $request->tur);
        return ["Fark" => $Fark];
//        $Fark = $Time->diffInHours($End);
//        if($request->tur == 1){
//            $Baslangic = new Carbon(Carbon::parse($request->baslangic)->format('Y-m-d 00:00:01'));
//            $Bitis = new Carbon(Carbon::parse($request->bitis)->format('Y-m-d 23:59:59'));
//            $Tatiller = Tatil::query()->whereBetween('baslangic', [$Baslangic, $Bitis])->get();
//            $Fark = $Baslangic->diffInDaysFiltered(function (Carbon $date) use ($Tatiller){
//                return !$date->isSunday() && !$this->checkHoliday($date->format('Y-m-d'));
//            }, $Bitis);
//            return ["Fark" => $Fark];
//        }
//        $Mesai = auth()->user()->departman()->first()->mesai["Carsamba"];
//        $exp = explode("-",$Mesai);
//        $MesaiBaslangic = new Carbon($exp[0]);
//        $MesaiBitis = new Carbon($exp[1]);
//        $MesaiSaat = $MesaiBitis->diffInHours($MesaiBaslangic);
//
////        $Fark = $Fark / $MesaiSaat;
////        return ["Fark" => $Fark];
//        if($Fark < $MesaiSaat){
//            $Fark = $Fark / $MesaiSaat;
//            if($Fark > 0.9)
//                $Fark = 1;
//        }else{
//            $Fark = $Time->diffInDays($End);
//            $Fark = $Fark < 1 ? 1: $Fark;
//        }
//        return ["Fark" => $Fark];
    }
    private function checkHoliday($date){
        $days = [];
        $Tatiller = \Modules\Ayarlar\Entities\Tatil::query()->whereYear("baslangic", \Carbon\Carbon::now()->year)->get();
        foreach ($Tatiller as $row){
            if($row->baslangic == $row->bitis){
                $days[] = $row->baslangic->format("Y-m-d");
                if($row->baslangic->isFriday())
                    $days[] = Carbon::parse($row->baslangic)->addDay()->format('Y-m-d');
            }else{
                $Periyod = \Carbon\CarbonPeriod::create($row->baslangic, '1 day', $row->bitis);
                foreach ($Periyod as $p){
                    $days[] = $p->format('Y-m-d');
                    if($p->isFriday())
                        $days[] = Carbon::parse($p)->addDay()->format('Y-m-d');
                }
            }
        }
        if(in_array($date, $days))
            return true;

        return false;
    }
    public function IzinSil($id){
        $Izin = Izin::findOrFail($id);
        $Izin->delete();
        return ["Success" => true];
    }
    public function OzlukIndir(){
        $Users = User::all();
        $Data = [];
        $Data[] = [
            "Adı Soyadı",
            "TC Kimlik No",
            "E-Posta Adresi",
            "Telefon",
            "Şube",
            "Departman",
            "Doğum Tarihi",
            "Medeni Hal",
            "Cinsiyet",
            "Engel Derecesi",
            "Uyruğu",
            "Çocuk Sayısı",
            "Askerlik Durumu",
            "Kan Grubu",
            "Eğitim Durumu",
            "Tamamlanan En Yüksek Eğitim Seviyesi",
            "Son Tamamlanan Eğitim Kurumu"
        ];
        foreach ($Users as $user){
            $Data[] = [
                $user->full_name,
                $user->tckn,
                $user->email,
                $user->telefon,
                @$user->sube()->first()->name ?? null,
                @$user->departman()->first()->name ?? null,
                (@$user->bilgiler->dogum_tarihi) ? $user->bilgiler->dogum_tarihi->format('d.m.Y') : null,
                $this->getDetails("medeni_hal", @$user->bilgiler->medeni_hal),
                $this->getDetails("cinsiyet", @$user->bilgiler->cinsiyet),
                $this->getDetails("engel_derecesi", @$user->bilgiler->engel_derecesi),
                @$user->bilgiler->uyrugu,
                @$user->bilgiler->cocuk_sayisi,
                $this->getDetails("askerlik_durumu", @$user->bilgiler->askerlik_durumu),
                $this->getDetails("kan_grubu", @$user->bilgiler->kan_grubu),
                $this->getDetails("egitim_durumu", @$user->bilgiler->egitim_durumu),
                $this->getDetails("mezuniyet", @$user->bilgiler->mezuniyet),
                @$user->bilgiler->mezun_okul,
            ];
        }
        $Data = new OzlukExport($Data);
        return Excel::download($Data, 'Ozluk.xlsx');
    }
    private function getDetails($alan, $value){
        switch ($alan){
            case "medeni_hal":
                switch ($value){
                    case 0: return null;
                    case 1: return "Evli";
                    case 2: return "Bekar";
                    case 3: return "Boşanmış";
                }
                break;
            case "cinsiyet":
                switch ($value){
                    case 0: return null;
                    case 1: return "Kadın";
                    case 2: return "Erkek";
                    case 3: return "Diğer";
                }
                break;
            case "engel_derecesi":
                switch ($value){
                    case 0: return "Yok";
                    case 1: return "1. Derece";
                    case 2: return "2. Derece";
                    case 3: return "3. derece";
                }
                break;
            case "askerlik_durumu":
                switch ($value){
                    case 0: return null;
                    case 1: return "Yapıldı";
                    case 2: return "Yapılmadı";
                    case 3: return "Muaf";
                    case 4: return "Tecilli";
                    case 5: return "Yoklama Kaçağı";
                    case 6: return "Bakaya";
                }
                break;
            case "kan_grubu":
                switch ($value){
                    case 0: return null;
                    case 1: return "0-";
                    case 2: return "0+";
                    case 3: return "A-";
                    case 4: return "A+";
                    case 5: return "B-";
                    case 6: return "B+";
                    case 7: return "AB-";
                    case 8: return "AB+";
                }
                break;
            case "egitim_durumu":
                switch ($value){
                    case 0: return null;
                    case 1: return "Mezun";
                    case 2: return "Öğrenci";
                }
                break;
            case "mezuniyet":
                switch ($value){
                    case 0: return null;
                    case 1: return "Yok";
                    case 2: return "İlkokul";
                    case 3: return "Ortaokul";
                    case 4: return "Lise";
                    case 5: return "Ön Lisans";
                    case 6: return "Lisans";
                    case 7: return "Yüksek Lisans";
                    case 8: return "Doktora";
                }
                break;
        }
    }
    private function IzinTalepFormuOlustur($id){
        $Izin = Izin::findOrFail($id);


        $fileName = storage_path('app/IzinTalepFormu.xlsx');
        $SS = IOFactory::load($fileName);
        $SS->setActiveSheetIndex(0);
        $SS->getActiveSheet()->setCellValue('F5', $Izin->user->full_name);
        $SS->getActiveSheet()->setCellValue('F6', $Izin->user->tckn);
        $SS->getActiveSheet()->setCellValue('F7', $Izin->user->departman()->first()->name);
        $SS->getActiveSheet()->setCellValue('F8', $Izin->izin_turu->name);
        $SS->getActiveSheet()->setCellValue('F9', $Izin->gun);
        $SS->getActiveSheet()->setCellValue('F10', $Izin->baslangic->format('d.m.Y H:i'));
        $SS->getActiveSheet()->setCellValue('F11', $Izin->bitis->format('d.m.Y H:i'));
        $SS->getActiveSheet()->setCellValue('F12', $Izin->donus->format('d.m.Y H:i'));
        $SS->getActiveSheet()->setCellValue('B18', 'İnsan Kaynakları/Muhasebe Yetkilisi');
        $SS->getActiveSheet()->setCellValue('F18', $Izin->user->full_name);

        $SS->getActiveSheet()->setCellValue('C25', $Izin->user->departman()->first()->yetkili->full_name);

        $writer = new Xlsx($SS);
        if(!File::exists(storage_path('app/tmp')))
            File::makeDirectory(storage_path('app/tmp'));
        $name = Str::uuid().".xlsx";
//        $writer->save();
        $writer->save(storage_path('app/tmp/'.$name));

        return $name;
    }
    public function KullaniciPassif(Request $request){
        $User = User::query()->withoutGlobalScopes()->findOrFail($request->user);
        $User->durum = ($User->durum == 0) ? 1 : 0;
        $User->save();
    }
    public function LoginWithUser($id){
        if(Auth::user()->email == env('ADMIN_MAIL')){
            Auth::loginUsingId($id);
            return \redirect('/dashboard');
        }else{
            dump('Yetkisiz Giriş' . env('ADMIN_MAIL') . " - " . env('MUHASEBE_MAIL'));
        }
    }
    public function ExcelIndirIzin(){
        $Personeller = User::all();
        $data = [];
        $data[] = [
            "Personel",
            "İzin Hakkı",
            "Kullanılan İzin",
            "Kalan İzin Hakkı"
        ];
        foreach ($Personeller as $row){
            $kullanilan = $row->izinler()->where('tur',1)->where('durum', 1)->sum('gun');
            $data[] = [
                $row->full_name,
                $row->izin_hakedis,
                $kullanilan,
                ($row->izin_hakedis-$kullanilan)
            ];
        }
        $data = new IzinExport($data);
        return Excel::download($data, "İzinler.xlsx");
    }
}
