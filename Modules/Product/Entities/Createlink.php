<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
class Createlink extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "createlink";

    protected $guarded = ['id'];
    
   
}
