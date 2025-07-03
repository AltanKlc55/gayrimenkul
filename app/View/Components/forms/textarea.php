<?php

namespace App\View\Components\forms;

use Illuminate\View\Component;

class textarea extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $title;
    public $name;
    public $entry;
    public $grid;
    public $lang;
    public $multilang;

    public function __construct($title= "",$name= "",$entry= "",$grid= "",$lang= false,$multilang= false)
    {
        $this->title = $title;
        $this->name = $name;
        $this->entry = $entry;
        $this->grid = $grid;
        $this->lang = $lang;
        $this->multilang = $multilang;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.textarea');
    }
}