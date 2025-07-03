<?php

namespace Modules\Admin\Entities;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permissions extends Model
{
    use Authenticatable;
    use HasFactory;

    protected $table = "permissions";
    protected $fillable = [
        'name',
        'group',
        'group_control',
        'module',
        'created_at',
        'updated_at',
        'deleted_at',
        'guard_name',
        'status',
    ];
   
}