<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CurrentBank extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('current_bank', function (Blueprint $table) {
            $table->id();
            $table->integer('current_id');
            
            $table->string('bank_name');
            $table->string('yetkili');
            $table->string('county');
            $table->string('city');
            $table->string('district');
            $table->string('branch');
            $table->string('tax_administration');
            $table->string('bank_account_id');
            $table->string('iban');
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
        Schema::dropIfExists('current_bank');

    }
}
