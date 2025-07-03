<?php

namespace App\View\Components\forms;

use Illuminate\View\Component;

class radio extends Component
{
    public $title;
    public $name;
    public $value;
    public $checked;
    public $attribute; // İnputa Opsiyonel Değer Ekleme
    public $required;
    public $disabled;
    public $grid;

    public function __construct($title= "",$name= "",$value= "",$checked= "",$attribute = "",$required ="",$disabled="",$grid = "")
    {
        $this->title = $title;
        $this->name = $name;
        $this->value = $value;
        $this->checked = $checked;
        $this->attribute = $attribute;
        $this->disabled = $disabled;
        $this->required = $required;
        $this->grid = $grid;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components..forms.radio');
    }
}