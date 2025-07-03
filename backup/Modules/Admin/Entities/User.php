<?php

namespace Modules\Admin\Entities;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements AuthenticatableContract
{
    use Authenticatable;
    use HasFactory;

    protected $table = "user";
    protected $fillable = [
        'username',
        'email',
        'password',
        'remember_token',
        'ghost',
        'authority',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected static function newFactory()
    {
        return \Modules\Admin\Database\factories\UserFactory::new();
    }
}