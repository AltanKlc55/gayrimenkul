<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductBuyyingChild extends Model
{

    use HasFactory;

    protected $table = "products_buyying_child";

    protected $guarded = ['id'];
}
