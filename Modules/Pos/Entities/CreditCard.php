<?php
namespace Modules\Pos\Entities;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class CreditCard extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = "creditcard";

    protected $guarded = ['id'];




}