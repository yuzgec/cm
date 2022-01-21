<?php

namespace App\View\Components\Widget;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;
use Modules\Personel\Entities\Puantaj;

class MesaiBilgileri extends Component
{
    public $FazlaMesai;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->FazlaMesai = Puantaj::query()
            ->select(DB::raw('user_id,SUM(fazla_calisma) AS mesai, SUM(gec_mesai) AS gec'))
            ->where('user_id', auth()->user()->id)
            ->whereYear('gun', Carbon::now()->format('Y'))
            ->whereMonth('gun', Carbon::now()->format('m'))
            ->groupBy('user_id')
            ->first();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.widget.mesai-bilgileri');
    }
}
