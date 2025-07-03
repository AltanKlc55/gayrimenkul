<?php

namespace Modules\Projects\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Projects extends Model
{

    use SoftDeletes;
    use HasFactory;

    protected $table = "projects";

    protected $guarded = ['id'];
}

