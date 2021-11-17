<?php

namespace Modules\Odeme\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Turkpos\Config;
use Turkpos\Soap;
use Turkpos\BuilderObject\Odeme;


class OdemeController extends Controller
{

    public function odemeal(Request $request){
  
        Config::$CLIENT_CODE = 41460;
        Config::$CLIENT_USERNAME = 'TP10072800';
        Config::$CLIENT_PASSWORD = '0088DCBA01823014';
        Config::$SERVICE_URI = 'https://posws.param.com.tr/turkpos.ws/service_turkpos_prod.asmx?wsdl';

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
        $guid = 'E8AAD860-80C3-4C35-9EF9-7E5D5FD1765D';
        $kkSahibi = $request->adsoyad;
        $kkNo = $request->kartno;
        $kkSkAy = $request->kartay;
        $kkSkYil = $request->kartyil;
        $kkCvc = $request->cvc;
        $kkSahibiGsm = "5332802852";
        $hataUrl = route('failed');
        $basariliUrl = route('success');
        $siparisId = time();
        $odemeUrl = route('odeme.index');
        $siparisAciklama = "siparis aciklama";
        $taksit = 1;
        $islemtutar = money($request->tutar);
        $toplamTutar = money($request->tutar + ( $request->tutar * 2.09 / 100 ));

        //dd($toplamTutar);

        $islemid = time();
        $ipAdr = $ip;
        $dataBir = $request->personel;
        $dataIki = " ";
        $dataUc = " ";
        $dataDort = " ";
        $dataBes = " ";

        $soap = new Soap();

        $nesne = new Odeme($spid, $guid, $kkSahibi, $kkNo, $kkSkAy, $kkSkYil, $kkCvc, $kkSahibiGsm,
            $hataUrl, $basariliUrl, $siparisId, $siparisAciklama, $taksit, $islemtutar, $toplamTutar, $islemid, $ipAdr, $odemeUrl,
            $dataBir, $dataIki, $dataUc, $dataDort, $dataBes);
        $res = $soap->send($nesne)->getSoapResultMethod();
         
        //dd($res);

        if($res['Sonuc'] == 1)
        {
            return redirect()->url($res['UCD_URL']);

        }else{

            return view('odeme::error', compact('res'));
        }
    }

    public function index()
    {


        return view('odeme::index');
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
