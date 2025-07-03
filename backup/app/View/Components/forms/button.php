<?php

namespace App\View\Components\forms;

use Illuminate\View\Component;

class Button extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $type; // İntput Türü
    public $title;
    public $class;
    public $id;
    public $icon;
    public $href;
    public $onclick;
    public $color;
    public function __construct($type = "",$title = "",$class = "",$id = "",$icon = "",$href = "",$onclick = "",$color = "")
    {
        $this->type = $type;
        $this->title = $title;
        $this->class = $class;
        $this->id = $id;
        $this->icon = $icon;
        $this->href = $href;
        $this->onclick = $onclick;
        $this->color = $color;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.button');
    }
}