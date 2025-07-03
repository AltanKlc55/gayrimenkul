<?php

namespace Modules\ExpertPanel\Entities;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpertUser extends Model implements AuthenticatableContract
{
    use Authenticatable;
    use HasFactory;

    protected $table = "expert_user";
    protected $fillable = [
        'language',
        'username',
        'email',
        'password',
        'image',
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
