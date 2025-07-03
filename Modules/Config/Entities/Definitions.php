<?php

namespace Modules\Config\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Definitions extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = "definitions";

    protected $guarded = ['id'];
}
