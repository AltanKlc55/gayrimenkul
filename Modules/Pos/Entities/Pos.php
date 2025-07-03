<?php
namespace Modules\Pos\Entities;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Pos extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = "pos";

    protected $guarded = ['id'];




}