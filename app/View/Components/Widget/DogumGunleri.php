<?php

namespace App\View\Components\Widget;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;
use Modules\Personel\Entities\PersonelBilgileri;

class DogumGunleri extends Component
{
    public $DOBS = [];
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->DOBS = PersonelBilgileri::query()
            ->addSelect('*')
            ->addSelect(DB::raw('DATE(CONCAT(YEAR(NOW()),"-",DATE_FORMAT(dogum_tarihi,"%m-%d"))) as tmp'))
            ->whereRaw('DATE(CONCAT(YEAR(NOW()),"-",DATE_FORMAT(dogum_tarihi,"%m-%d"))) >= DATE(NOW())')
            ->orderByRaw('MONTH(dogum_tarihi)')
            ->orderByRaw('DAY(dogum_tarihi)')
            ->limit(5)->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.widget.dogum-gunleri');
    }
}
