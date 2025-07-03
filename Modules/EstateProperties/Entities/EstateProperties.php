<?php
namespace Modules\EstateProperties\Entities;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class EstateProperties extends Model
{

    use HasFactory;

    use SoftDeletes;

    protected $table = "tbl_ilan_ozellik_kategori";

    protected $guarded = ['id'];


}
