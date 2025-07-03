<?php

namespace Modules\Current\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class CurrentType extends Model
{

    use SoftDeletes;
    use HasFactory;

    protected $table = "current_type";

    protected $guarded = ['id'];
}
