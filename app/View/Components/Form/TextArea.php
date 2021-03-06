<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class TextArea extends Component
{
    public $label;
    public $name;
    public $class;
    public $row;

    public function __construct($label, $name, $class = "form-control", $row = 5)
    {
        $this->label = $label;
        $this->name = $name;
        $this->class = $class;
        $this->row = $row;
    }

    public function render()
    {
        return view('components.form.text-area');
    }
}
