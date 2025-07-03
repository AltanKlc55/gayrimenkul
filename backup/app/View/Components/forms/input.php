<?php

namespace App\View\Components\forms;

use Illuminate\View\Component;

class input extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $type; // İntput Türü
    public $title; // Form Label Başlığı
    public $name; //  Vertiabanı Kolon Adı
    public $entry; // Düzenlemedeki  veri alanı
    public $path; // Dosya Yolu
    public $readonly;
    public $description; // Bilgilendirme Alanı
    public $class;
    public $required;
    public $filetype; // Eklenen Dosya Türü "image - Doc"
    public $attribute; // İnputa Opsiyonel Değer Ekleme
    public $disabled;
    public $grid;
    public $id;
    public function __construct($type= "",$title= "",$name= "",$entry= "",$path= "",$readonly= "",$description = "",$class = "",$required="",$filetype="",$attribute="",$disabled="",$grid="",$id="")
    {
        $this->type = $type;
        $this->title = $title;
        $this->name = $name;
        $this->entry = $entry;
        $this->path = $path;
        $this->readonly = $readonly;
        $this->description = $description;
        $this->class = $class;
        $this->required = $required;
        $this->filetype = $filetype;
        $this->attribute = $attribute;
        $this->disabled = $disabled;
        $this->grid = $grid;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.input');
    }
}