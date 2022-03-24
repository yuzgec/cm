<?php

namespace App\View\Components\Widget;

use Illuminate\View\Component;
use Modules\Odeme\Entities\Odeme;

class SonOdemeler extends Component
{
    public $OdemeListesi;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->OdemeListesi = Odeme::with('getPersonel')->where('odeme_cevap', 1)->limit(200)->latest()->paginate(10);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.widget.son-odemeler');
    }
}
