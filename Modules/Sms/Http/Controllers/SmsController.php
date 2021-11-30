<?php

namespace Modules\Sms\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Sms\Entities\SmsSablon;
class SmsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('sms::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('sms::create');
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
        return view('sms::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('sms::edit');
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

    public function smsgonder(){
        $sms_sablon = SmsSablon::all();
        $secilen_sablon = SmsSablon::find(\request('smssablon'));
        return view('sms::smsgonder', compact('sms_sablon', 'secilen_sablon'));
    }

    public function toplusmsgonder(){
        $sms_sablon = SmsSablon::all();
        $secilen_sablon = SmsSablon::find(\request('smssablon'));

        return view('sms::toplusmsgonder', compact('sms_sablon', 'secilen_sablon'));
    }

    public function excelsmsgonder(){
        return view('sms::excelsmsgonder');
    }


    public function smsraporlama(){
        return view('sms::smsraporlama');
    }
}
