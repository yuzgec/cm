<?php

namespace Modules\Odeme\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Nwidart\Modules\Facades\Module;
use Turkpos\BuilderObject\BinSanalPos;
use Turkpos\BuilderObject\TpOzelOranListele;
use Turkpos\BuilderObject\TpOzelOranSkListe;
use Turkpos\Config;
use Turkpos\Soap;
use Turkpos\BuilderObject\Odeme;
use Validator;

class OdemeController extends Controller
{

    public function __construct(){
        Config::$CLIENT_CODE        = \config('odeme.code');
        Config::$CLIENT_USERNAME    = \config('odeme.user');
        Config::$CLIENT_PASSWORD    = \config('odeme.pass');
        Config::$GUID               = \config('odeme.guid');
        Config::$SERVICE_URI        = \config('odeme.url');
    }

    public function odemeal(Request $request){
        $validator = Validator::make($request->all(), [
            "tutar" => "required",
            "adsoyad" => "required",
            "kartno" => "required",
            "cvc" => "required",
            "aciklama" => "required"
        ],[
            "tutar.required" => "Lütfen Tutar belirtin",
            "adsoyad.required" => "Lütfen İsim Soyisim belirtin",
            "kartno.required" => "Lütfen Kart No belirtin",
            "cvc.required" => "Lütfen CVV belirtin",
            "aciklama.required" => "Lütfen Açıklama belirtin",
        ]);
        if(!$validator->passes()){
            return response()->json(["Success" => false, "Errors" => $validator->errors()->all()]);
        }

        Config::$CLIENT_CODE        = \config('odeme.code');
        Config::$CLIENT_USERNAME    = \config('odeme.user');
        Config::$CLIENT_PASSWORD    = \config('odeme.pass');
        Config::$GUID               = \config('odeme.guid');
        Config::$SERVICE_URI        = \config('odeme.url');
        ## Kullanıcının IP adresi
        if( isset( $_SERVER["HTTP_CLIENT_IP"] ) ) {
            $ip = $_SERVER["HTTP_CLIENT_IP"];
        } elseif( isset( $_SERVER["HTTP_X_FORWARDED_FOR"] ) ) {
            $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        } else {
            $ip = $_SERVER["REMOTE_ADDR"];
        }

        $soap = new Soap();
        $spid = 1011;
        $guid = "E8AAD860-80C3-4C35-9EF9-7E5D5FD1765D";
        $kkSahibi = $request->adsoyad;
        $kkNo = $request->kartno;
        $kkSkAy = $request->kartay;
        $kkSkYil = $request->kartyil;
        $kkCvc = $request->cvc;
        $kkSahibiGsm = "5321347703";
        $hataUrl = url('OdemeSonuc');
        $basariliUrl = url('OdemeSonuc');
        $siparisId = time();
        $odemeUrl = route('odeme.index');
        $siparisAciklama = $request->aciklama;
        $taksit = $request->taksit;

        $islemtutar = money($request->tutar);
        $toplamTutar = money($request->tutar + ( $request->tutar * $request->oran / 100 ));

        $islemid    = time();

        if (config('app.env') === 'prod'){
            $ipAdr      = "78.188.150.116";
        }else{
            $ipAdr      = $ip;
        }

        $dataBir    = $request->dosyaNo;
        $dataIki    = $request->tcKimlikNo;
        $dataUc     = $request->adsoyad;
        $dataDort   = substr($request->kartno, -4);
        $dataBes    = $request->user()->id;

        $soap       = new Soap();

        $nesne      = new Odeme($spid, $guid, $kkSahibi, $kkNo, $kkSkAy, $kkSkYil, $kkCvc, $kkSahibiGsm,
            $hataUrl, $basariliUrl, $siparisId, $siparisAciklama, $taksit, $islemtutar, $toplamTutar, $islemid, $ipAdr, $odemeUrl,
            $dataBir, $dataIki, $dataUc, $dataDort, $dataBes);
//        dd('Burada');
//        dd($nesne);

        $res        = $soap->send($nesne)->getSoapResultMethod();

        if($res['UCD_URL'] == ""){
            return response()->json(["Success" => false, "Errors" => $res["Sonuc_Str"]]);
            return redirect()->route('odeme.index');
        }
//        dd($res);
        return response()->json(["Success" => true, "URL" => $res["UCD_URL"]]);
        //return redirect($res['UCD_URL']);

    }

    public function odemesonuc(Request $request)
    {

        $extra = explode('|',$request->TURKPOS_RETVAL_Ext_Data);

        $odeme = new \Modules\Odeme\Entities\Odeme;

        $odeme->islem_id             = $request->TURKPOS_RETVAL_Siparis_ID;
        $odeme->personel_id          = auth()->user()->id;
        $odeme->dosya_no             = $extra[0];
        $odeme->tckn                 = $extra[1];
        $odeme->ad_soyad             = $extra[2];
        $odeme->kart_no              = $extra[3];
        $odeme->odeme_turu           = $extra[4];
        $odeme->dekont_id            = $request->TURKPOS_RETVAL_Dekont_ID;
        $odeme->islem_id             = $request->TURKPOS_RETVAL_Islem_ID;
        $odeme->odeme_tutari         = str_replace([","],["."],$request->TURKPOS_RETVAL_Odeme_Tutari);
        $odeme->odeme_komisyon       = str_replace([","],["."],$request->TURKPOS_RETVAL_Tahsilat_Tutari);

        if ($request->TURKPOS_RETVAL_Sonuc == 1) {
            $odeme->odeme_durumu         = $request->TURKPOS_RETVAL_Sonuc_Str;
        }else{
            $odeme->odeme_durumu           = $request->TURKPOS_RETVAL_Sonuc_Str;
            $odeme->odeme_hata_mesaji      = $request->TURKPOS_RETVAL_Sonuc_Str;
        }

        if ($request->TURKPOS_RETVAL_Sonuc == 1) {
            $odeme->odeme_cevap           = 1;
        }else{
            $odeme->odeme_cevap           = 0;
        }

        $odeme->save();

        if ($request->TURKPOS_RETVAL_Sonuc == 1){
            return view('odeme::success', compact('request'));
        }else{
            return view('odeme::index', compact('request'));
        }

    }

    public function index()
    {
        $gunluktoplam = DB::table('odeme')
            ->where('created_at', Carbon::today())
            ->where('personel_id', auth()->user()->id)
            ->where('odeme_cevap', 1)
            ->sum('odeme.odeme_tutari');

        $baslangic       = Carbon::today();
        $bitis           = Carbon::now();
        $odemegecmisi    = \Modules\Odeme\Entities\Odeme::where('personel_id', auth()->user()->id)->whereBetween('created_at', [$baslangic, $bitis])->get();


        $Oranlar = null;
        if(Storage::exists('oranlistesi.json')){
            $Oranlar = Storage::get('oranlistesi.json');
            $Oranlar = json_decode($Oranlar);
            if($Oranlar->Tarih != Carbon::now()->format('Y-m-d')){
                $Oranlar = $this->OranGetir();
                $Oranlar["Tarih"] = Carbon::now()->format('Y-m-d');
                Storage::put('oranlistesi.json', json_encode($Oranlar));
            }
        }else{
            $Oranlar = $this->OranGetir();
            $Oranlar["Tarih"] = Carbon::now()->format('Y-m-d');
            Storage::put('oranlistesi.json', json_encode($Oranlar));
        }
        $Taksitler = [];
        for ($i=1;$i<=12;$i++){
            $Taksitler[] = ["label" => $i." Taksit", "id" => $i];
        }
        return view('odeme::index', compact('odemegecmisi', 'gunluktoplam','Taksitler'));
    }
    private function OranGetir(){
        $OzelOranListesi = new TpOzelOranSkListe(\config('odeme.guid'));
        $soap = new Soap();
        $res = $soap->send($OzelOranListesi)->getAnyData();
        $Oranlar = (count($res["DT_Ozel_Oranlar_SK"])) ? $res["DT_Ozel_Oranlar_SK"] : null;
        return $Oranlar;
    }
    public function Oranlar(Request $request){
        if(strlen($request->cc)<6)
            return ["Success" => false];
        $Oranlar = collect(json_decode(\Illuminate\Support\Facades\Storage::get('oranlistesi.json')));
        $cc = @substr($request->cc,0,6);
        $OranGetir = new BinSanalPos(substr($cc, 0,6));
        $soap = new Soap();
        $res = $soap->send($OranGetir)->getAnyData();
        $res = (array)$res["Temp"];
        $Oran = $Oranlar->where("SanalPOS_ID", $res["SanalPOS_ID"])->first();
        $Ret = [];
        for($i=1; $i<=12; $i++){
            if($i == 1 && (float)$Oran->MO_01 == 0){
                $Ret[] = [
                    "Taksit" => $i,
                    "Oran" => 1.6900
                ];
                continue;
            }
            $T = $i < 10 ? "MO_0" . $i : "MO_".$i;
            if((float)$Oran->$T<0)
                continue;
            $Ret[] = [
                "Taksit" => $i,
                "Oran" => (float)$Oran->$T
            ];
        }
//        dd($Ret);
//        $Taksit = ($request->taksit < 10)?"MO_0".$request->taksit:"MO_".$request->taksit;
        return ["Success" => true, "Oranlar" => $Ret];
    }
    public function create()
    {
        return view('odeme::create');
    }


    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return view('odeme::show');
    }

    public function edit($id)
    {
        return view('odeme::edit');
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
