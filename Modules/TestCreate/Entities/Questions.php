<?php

namespace Modules\TestCreate\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Questions extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = "tbl_questions";

    protected $fillable = ['answers_json', 'question'];

    protected $casts = [
        'answers_json' => 'array',  
    ];

    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();
    }
}
