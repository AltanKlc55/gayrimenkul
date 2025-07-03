<?php

namespace Modules\Finance\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FinanceHistory extends Model
{

    protected $table = "finance_history";
    protected $guarded = ['id'];

}
