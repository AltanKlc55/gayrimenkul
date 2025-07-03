<?php

namespace Modules\Offer\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class OfferChild extends Model
{

    use HasFactory;

    protected $table = "offer_child";

    protected $guarded = ['id'];
}
