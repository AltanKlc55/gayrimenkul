<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HasPermision extends Model
{
  

    protected $table = "role_has_permissions";
    protected $fillable = [
        'permission_id',
        'role_id',
    ];
}