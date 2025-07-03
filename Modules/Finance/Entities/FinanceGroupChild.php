<?php

namespace Modules\Finance\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FinanceGroupChild extends Model
{
    use HasFactory;

    protected $table = "finance_group_child";
    protected $guarded = ['id'];

}
