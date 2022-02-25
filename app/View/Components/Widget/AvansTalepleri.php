<?php

namespace App\View\Components\Widget;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;
use Modules\IK\Entities\Avans;

class AvansTalepleri extends Component
{
    public $Avanslar = [];
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $Rows = Auth::user()->DepartmanYonetici()->with('users.avanslar')->get();
        foreach ($Rows as $row){
            foreach ($row->users as $user){
                foreach($user->avanslar as $avans){
                    if($avans->onaylar["Yetkili"] == 0){
                        $this->Avanslar[] = $avans;
                    }
                }
            }
        }
        if(env('MUHASEBE_MAIL') == Auth::user()->email OR Auth::user()->email == 'orhan.ozcan@mecitkahraman.com.tr'){
            $Rows = Avans::query()->where('durum',0)->where('onaylar->Muhasebe',0)->where('onaylar->Yetkili', 1)->get();
            foreach ($Rows as $row){
                $this->Avanslar[] = $row;
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
        return view('components.widget.avans-talepleri');
    }
}
