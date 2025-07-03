<?php

namespace App\View\Components\forms;

use Illuminate\View\Component;

class select extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $title; // Select Başlığı
    public $name; //Select Adı
    public $selected; // Seçili option
    public $options; // optionlar
    public $multiple; // Çoklu seçim izni
    public $tags;

    public $required;
    public $readonly;
    public $disable;
    public $format;
    public $grid;
    public $description;
    public $attribute;
    public $class;
    public $id;
    public $child;

    public function __construct($title= "",$name= "",$selected= "",$options= "",$multiple= "",$tags= "",$required= "",$readonly= "",$disable= "",$format= "",$grid= "",$description="",$attribute="",$class = "",$id = "",$child = "")
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
        $this->format = $format;
        $this->grid = $grid;
        $this->description = $description;
        $this->attribute = $attribute;
        $this->class = $class;
        $this->id = $id;
        $this->child = $child;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.select');
    }
}