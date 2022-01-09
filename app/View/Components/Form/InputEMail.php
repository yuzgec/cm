<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class InputEMail extends Component
{
    public $label;
    public $name;
    public $class;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label, $name, $class = "form-control")
    {
        $this->label = $label;
        $this->name = $name;
        $this->class = $class;
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.input-e-mail');
    }
}
