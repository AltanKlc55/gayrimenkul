<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
class ProductChild extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = "products_child";

    protected $guarded = ['id'];
   

}