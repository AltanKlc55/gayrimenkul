<?php

namespace App\View\Components\forms;

use Illuminate\View\Component;

class radio extends Component
{
    public $title;
    public $name;
    public $entry;
    public $checked;
    public $attribute; // İnputa Opsiyonel Değer Ekleme
    public $required;
    public $disabled;
    public $grid;
    public $readonly;

    public function __construct($title= "",$readonly="",$name= "",$entry= "",$checked= "",$attribute = "",$required = "",$disabled = "",$grid = "")
    {
        $this->title = $title;
        $this->name = $name;
        $this->entry = $entry;
        $this->checked = $checked;
        $this->attribute = $attribute;
        $this->readonly = $readonly;
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