<?php

namespace Modules\Odeme\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Turkpos\Config;
use Turkpos\Soap;
use Turkpos\BuilderObject\Odeme;


class OdemeController extends Controller
{

    public function odemeal(Request $request){
        dd(route('odeme.index'));


        Config::$CLIENT_CODE        = env('CLIENT_CODE');
        Config::$CLIENT_USERNAME    = env('CLIENT_USERNAME');
        Config::$CLIENT_PASSWORD    = env('CLIENT_PASSWORD');
        Config::$SERVICE_URI        = env('SERVICE_URI');

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
        $guid = env('GUID');
        $kkSahibi = $request->adsoyad;
        $kkNo = $request->kartno;
        $kkSkAy = $request->kartay;
        $kkSkYil = $request->kartyil;
        $kkCvc = $request->cvc;
        $kkSahibiGsm = "5555555555";
        $hataUrl = route('odemesonuc');
        $basariliUrl = route('odemesonuc');
        $siparisId = time();
        $odemeUrl = route('odeme.index');
        $siparisAciklama = $request->aciklama;
        $taksit = 1;

        $islemtutar = money($request->tutar);
        $toplamTutar = money($request->tutar + ( $request->tutar * 1.69 / 100 ));

        $islemid    = time();

        if (config('app.env') === 'production'){
            $ipAdr      = "78.188.150.116";
        }else{
            $ipAdr      = $ip;
        }

        $dataBir    = $request->dosyaNo;
        $dataIki    = $request->tcKimlikNo;
        $dataUc     = $request->adsoyad;
        $dataDort   = substr($request->kartno, -4);
        $dataBes    = 1;

        $soap       = new Soap();

        $nesne      = new Odeme($spid, $guid, $kkSahibi, $kkNo, $kkSkAy, $kkSkYil, $kkCvc, $kkSahibiGsm,
            $hataUrl, $basariliUrl, $siparisId, $siparisAciklama, $taksit, $islemtutar, $toplamTutar, $islemid, $ipAdr, $odemeUrl,
            $dataBir, $dataIki, $dataUc, $dataDort, $dataBes);

        //dd($nesne);

        $res        = $soap->send($nesne)->getSoapResultMethod();

        if($res['UCD_URL'] == ""){
            return redirect()->route('odeme.index');
        }

        return redirect($res['UCD_URL']);

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


        $gunluktoplam = DB::table('odeme')->sum('odeme.odeme_komisyon');

        //dd($gunluktoplam);

        $baslangic       = Carbon::today();
        $bitis           = Carbon::now();
        //dd($baslangic);
        $odemegecmisi    = \Modules\Odeme\Entities\Odeme::where('personel_id', auth()->user()->id)->whereBetween('created_at', [$baslangic, $bitis])->get();
        return view('odeme::index', compact('odemegecmisi', 'gunluktoplam'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('odeme::create');
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
        return view('odeme::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('odeme::edit');
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
