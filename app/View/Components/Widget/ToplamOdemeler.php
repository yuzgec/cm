<?php

namespace App\View\Components\Widget;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class ToplamOdemeler extends Component
{
    public $GunlukToplam;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->GunlukToplam = DB::table('odeme')
            ->where('created_at', Carbon::today())
            ->where('odeme_cevap', 1)
            ->sum('odeme.odeme_tutari');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.widget.toplam-odemeler');
    }
}
