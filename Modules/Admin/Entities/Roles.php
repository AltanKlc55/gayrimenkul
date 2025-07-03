<?php

namespace Modules\Admin\Entities;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model implements AuthenticatableContract
{
    use Authenticatable;
    use HasFactory;

    protected $table = "roles";
    protected $fillable = [
        'name',
        'default',
        'created_at',
        'updated_at',
        'deleted_at',
        'guard_name',
        'status',
    ];


}