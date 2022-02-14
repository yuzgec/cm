<?php

namespace Modules\IK\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Modules\Ayarlar\Entities\Departman;
use Modules\Ayarlar\Entities\Sube;
use Modules\IK\Emails\IzinTalep;
use Modules\IK\Entities\Avans;
use Modules\IK\Entities\Izin;
use Modules\IK\Jobs\IzinTalepEMailJob;
use Modules\Kullanici\Entities\Puantaj;
use Modules\Personel\Entities\Mesai;
use Modules\Personel\Entities\Personel;
use Modules\Personel\Entities\PersonelBilgileri;
use PhpOffice\PhpSpreadsheet\IOFactory;
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
        $baslangic = Carbon::parse($Talep["baslangic_tarihi"]." " . $Talep["baslangic_saati"]);
        $bitis = Carbon::parse($Talep["bitis_tarihi"]." " . $Talep["bitis_saati"]);
        $gun = $bitis->diffInDays($baslangic)+1;
        if($gun < 1)
            if($bitis->diffInHours($baslangic))
                $gun = 1;

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
        dispatch(new IzinTalepEMailJob($Izin,$Izin->user->email, $Mesaj));
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
        $Avans->onaylar = [
            "Yetkili" => 0,
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
            ->get();

        $RaporTarih = Carbon::parse($HaftaBaslangic)->translatedFormat('d F Y').' - '.Carbon::parse($HaftaBitis)->translatedFormat('d F Y');
        $Gunler = ['Pazartesi', 'Salı', 'Çarşamba', 'Perşembe', 'Cuma', 'Cumartesi', 'Pazar'];
        $Personeller = [];

        dd($MesaiRapor->first());
        foreach ($MesaiRapor as $Row){
            $Personeller[$Row->user_id][] = $Row;
            if($Row->user_id == 23)
                dd($Row);
        }
        $KalanIzinler = [];
        foreach (User::all() as $user){
            $BuYil = Carbon::now()->firstOfYear();
            $kullanilan = $user->izinler()->where('tur',1)->whereYear('baslangic', $BuYil->year)->where('durum',1)->sum('gun');
            $kalan = $user->izin_hakki - $kullanilan;
            $user->kalan_izin = $kalan;
            $user->kullanilan = $kullanilan;
            $KalanIzinler[] = $user;
        }
        $Personel = Personel::with('mesai')->paginate(5);
        $YaklasanIzinler = [];
        $OnayBekleyenler = [];
        $Onaylananlar = [];
        $Reddedilenler = [];
        if(auth()->user()->departman()->first()->name == "Muhasebe"){
            foreach (User::all() as $user){
                foreach ($user->izinler as $izin){
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
            'KalanIzinler'
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

        $baslangic = Carbon::parse($data["baslangic_tarihi"]." " . $data["baslangic_saati"]);
        $bitis = Carbon::parse($data["bitis_tarihi"]." " . $data["bitis_saati"]);
        $gun = $bitis->diffInDays($baslangic)+1;
        if($gun < 1)
            if($bitis->diffInHours($baslangic))
                $gun = 1;

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
        $Izin = Izin::findOrFail($id);


        $fileName = storage_path('app/IzinTalepFormu.xlsx');
        $SS = IOFactory::load($fileName);
        $SS->setActiveSheetIndex(0);
        $SS->getActiveSheet()->setCellValue('F5', $Izin->user->full_name);
        $SS->getActiveSheet()->setCellValue('F6', $Izin->user->tckn);
        $SS->getActiveSheet()->setCellValue('F7', $Izin->user->departman()->first()->name);
        $SS->getActiveSheet()->setCellValue('F8', $Izin->izin_turu);
        $SS->getActiveSheet()->setCellValue('F9', $Izin->gun);
        $SS->getActiveSheet()->setCellValue('F10', $Izin->baslangic->format('d.m.Y H:i'));
        $SS->getActiveSheet()->setCellValue('F11', $Izin->bitis->format('d.m.Y H:i'));
        $SS->getActiveSheet()->setCellValue('F12', $Izin->donus->format('d.m.Y H:i'));
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="IzinTalepFormu.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = IOFactory::createWriter($SS, 'Xlsx');
        $writer->save('php://output');
    }
    public function IzinMutabakat(){
        $BuYil = Carbon::now()->firstOfYear();
        $kullanilan = \auth()->user()->izinler()->where('tur',1)->whereYear('baslangic', $BuYil->year)->where('durum',1)->sum('gun');
        $fileName = storage_path('app/IzinMutabakat.xlsx');
        $SS = IOFactory::load($fileName);
        $SS->setActiveSheetIndex(0);
        $SS->getActiveSheet()->setCellValue('A3','Ad Soyadı : ' . \auth()->user()->full_name);
        $SS->getActiveSheet()->setCellValue('C3','T.C. Kimlik : ' . \auth()->user()->tckn);
        $SS->getActiveSheet()->setCellValue('F3','İşe Giriş Tarihi : ');
        $SS->getActiveSheet()->setCellValue('A4','Birim : ' . \auth()->user()->departman()->first()->name);

        $SS->getActiveSheet()->setCellValue('A9','Devir Gelen : 0 gün');
        $SS->getActiveSheet()->setCellValue('C9','Bu Yıl Kazanılan :' . \auth()->user()->izin_hakki . 'gün');
        $SS->getActiveSheet()->setCellValue('F9','Bu Yıl Kullanılan :' . $kullanilan. 'gün');

        $SS->getActiveSheet()->setCellValue('A10','Toplam : '.\auth()->user()->izin_hakki.' gün');
        $SS->getActiveSheet()->setCellValue('C10','Bu Yıl Kazanılan :' . $kullanilan . 'gün');
        $SS->getActiveSheet()->setCellValue('F10','Bu Yıl Kullanılan :' . (\auth()->user()->izin_hakki - $kullanilan). 'gün');

        $SS->getActiveSheet()->setCellValue('A15', ' Tarihleri Arasında Kullandığım İzinler');


        $SS->getActiveSheet()->setCellValue('A36', 'Yukarıda belirtilen kalan izin günümün doğru olduğunu ve listede yer alan tüm izinleri kullandığımı kabul ve taahhüt ediyorum');
        $SS->getActiveSheet()->setCellValue('A39', 'Ad Soyad');
        $SS->getActiveSheet()->setCellValue('A42', 'İmza');
        $SS->getActiveSheet()->setCellValue('E40', Carbon::now()->locale('tr')->translatedFormat('d F Y'));
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="IzinMutabakat.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = IOFactory::createWriter($SS, 'Xlsx');
        $writer->save('php://output');
    }
}
