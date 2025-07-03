<?php

namespace App\View\Components\forms;

use Illuminate\View\Component;

class category extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $title;
    public $options;
    public $multiple;
    public $name; //Select Adı
    public $selected; // Seçili option
    public $tags;
    public $required;
    public $readonly;
    public $disable;
    public $grid;
    public $description;
    public $attribute;
    public $class;
    public $id;

    public function __construct($title= "",$name= "",$selected= "",$options= "",$multiple= "",$tags= "",$required= "",$readonly= "",$disable= "",$grid= "",$description="",$attribute="",$class = "",$id = "")
    {
        $this->title = $title;
        $this->name = $name;
        $this->selected = $selected;
        $this->options = $options;
        $this->multiple = $multiple;
        $this->tags = $tags;
        $this->required = $required;
        $this->readonly = $readonly;
        $this->disable = $disable;
        $this->grid = $grid;
        $this->description = $description;
        $this->attribute = $attribute;
        $this->class = $class;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.category');
    }
}