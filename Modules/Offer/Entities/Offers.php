<?php

namespace Modules\Offer\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Offers extends Model
{

    use HasFactory;

    protected $table = "offers";

    protected $guarded = ['id'];
}
