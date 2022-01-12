<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class SelectBox extends Component
{

    public $label;
    public $name;
    public $class;
    public $list;
    public function __construct($label, $name, $list, $class = "form-control")
    {
        $this->label = $label;
        $this->name = $name;
        $this->list = $list;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.select-box');
    }
}
