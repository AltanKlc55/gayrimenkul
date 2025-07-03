<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeLeaveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        Schema::create('employee_leave', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->string('title');
            $table->string('note');
            $table->integer('leave_type')->comment('İzin Türü');
            $table->string('leave_day')->comment('İzin Süresi');
            $table->date('start_date')->comment('Başlama Tarihi');
            $table->date('end_date')->comment('Bitiş Tarihi');
            $table->string('contract_file')->comment('Belge');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_leave');
    }
}
