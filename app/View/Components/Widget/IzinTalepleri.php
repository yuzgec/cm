<?php

namespace App\View\Components\Widget;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;
use Modules\IK\Entities\Izin;

class IzinTalepleri extends Component
{
    public $Izinler = [];
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $Rows = Auth::user()->DepartmanYonetici()->with('users.izinler')->get();
        foreach ($Rows as $row){
            foreach ($row->users as $user){
                foreach($user->izinler as $izin){
                    if($izin->onaylar["Yetkili"] == 0){
                        $this->Izinler[] = $izin;
                    }
                }
            }
        }
        if(env('MUHASEBE_MAIL') == Auth::user()->email){
            $Rows = Izin::query()->where('durum',0)->where('onaylar->Muhasebe',0)->where('onaylar->Yetkili', 1)->get();
            foreach ($Rows as $row){
                $this->Izinler[] = $row;
            }
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.widget.izin-talepleri');
    }
}
