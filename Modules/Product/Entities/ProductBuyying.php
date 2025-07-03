<?php

namespace Modules\Product\Entities;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductBuyying extends Model
{

    use SoftDeletes;
    use HasFactory;

    protected $table = "products_buyying";

    protected $guarded = ['id'];
}
