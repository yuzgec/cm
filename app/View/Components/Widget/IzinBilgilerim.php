<?php

namespace App\View\Components\Widget;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class IzinBilgilerim extends Component
{
    public $Izinler = [];
    public $Hakedis = 14;
    public $Kullanilan = 0;
    public $Kalan = 0;
    public $Yuzde;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->Izinler = Auth::user()->izinler()->latest()->limit(5)->get();
        $this->Hakedis = Auth::user()->izin_hakki;
        $IsBasi = Auth::user()->bilgiler->ise_baslama_tarihi;
        $BuYil = Carbon::now()->firstOfYear();
        $BuYil = Carbon::parse(Carbon::now()->format('Y-').$IsBasi->format("m-d"))->subYear();
        $this->Kullanilan = Auth::user()->izinler()->where('tur',1)->whereYear('baslangic', $BuYil->year)->where('durum',1)->sum('gun');
        $this->Yuzde = $this->Kullanilan / $this->Hakedis * 100;
        $this->Kalan = $this->Hakedis - $this->Kullanilan;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.widget.izin-bilgilerim');
    }
}
