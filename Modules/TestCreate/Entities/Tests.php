<?php

namespace Modules\TestCreate\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Tests extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = "tbl_tests";

    protected $fillable = ['questions', 'test_name','test_description','result_points'];

    protected $casts = [
        'result_points' => 'array',
    ];

    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();
    }
}
