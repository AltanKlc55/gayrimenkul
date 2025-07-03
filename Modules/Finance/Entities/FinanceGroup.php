<?php

namespace Modules\Finance\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FinanceGroup extends Model
{

    protected $table = "finance_group";
    protected $guarded = ['id'];


}
