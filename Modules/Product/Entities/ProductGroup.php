<?php


namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductGroup extends Model
{

    use HasFactory;

    protected $table = "products_group";

    protected $guarded = ['id'];
}

