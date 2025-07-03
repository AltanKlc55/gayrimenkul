<?php

namespace Modules\Bill\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bill extends Model
{

    use HasFactory;

    use SoftDeletes;

    protected $table = "bill";

    protected $guarded = ['id'];


}
