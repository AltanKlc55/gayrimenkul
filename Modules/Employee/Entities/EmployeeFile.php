<?php

namespace Modules\Employee\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeFile extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = "employee_files";

    protected $guarded = ['id'];
}
