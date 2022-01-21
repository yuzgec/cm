<?php

namespace App\View\Components\Widget;

use Carbon\Carbon;
use Illuminate\View\Component;
use Modules\IK\Entities\Izin;

class IzinTaleplerim extends Component
{
    public $Izinlerim = [];
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $Tarih = Carbon::now()->startOfMonth();
        $this->Izinlerim = Izin::query()
            ->where('user_id', request()->user()->id)
            ->whereDate('created_at', '>=', $Tarih->format('Y-m-d'))->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.widget.izin-taleplerim');
    }
}
