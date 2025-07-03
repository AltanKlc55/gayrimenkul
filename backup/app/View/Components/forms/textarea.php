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

    public function __construct($title= "",$name= "",$entry= "",$grid= "")
    {
        $this->title = $title;
        $this->name = $name;
        $this->entry = $entry;
        $this->grid = $grid;

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