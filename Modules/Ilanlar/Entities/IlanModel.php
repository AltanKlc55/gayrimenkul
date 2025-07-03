<?php

namespace Modules\Ilanlar\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class IlanModel extends Model
{

    use HasFactory;

    use SoftDeletes;

    protected $table = "tbl_ilan";

    protected $casts = [
        'property_properties' => 'array',
        'images' => 'array'
    ];


    protected $guarded = ['id'];


}
