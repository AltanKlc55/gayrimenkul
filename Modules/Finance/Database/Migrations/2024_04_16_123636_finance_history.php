<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FinanceHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finance_history', function (Blueprint $table) {
            $table->increments('id');
            $table->increments('type');
            $table->integer('current_id')->default(0);
            $table->integer('group_id')->default(0);
            $table->integer('child_id')->default(0);
            $table->decimal('amount',30,2)->default(0);
            $table->float('tax')->default(0);
            $table->string('process_desc')->default(0);
            $table->integer('period')->default(0);
            $table->timestamp('period_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('process_date')->default(DB::raw('CURRENT_TIMESTAMP'));
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
        Schema::dropIfExists('finance_history');
    }
}
