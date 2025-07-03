<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Invoice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice', function (Blueprint $table) {
            $table->id();
            $table->integer('current_id')->default(0)->comment('Cari No');
            $table->string('invoice_id')->comment('Fatura No');
            $table->integer('invoice_type')->comment('Fatura Türü');
            $table->string('invoice_file')->comment('Fatura Dosyası');
            $table->decimal('amount', 10, 2)->default(0)->comment('Fiyat');
            $table->integer('vat')->default(0)->comment('KDV');
            $table->integer('auth')->default(0)->comment('Ekleyen');
            $table->timestamp('invoice_date')->default(DB::raw('CURRENT_TIMESTAMP'));
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
        Schema::dropIfExists('invoice');
    }
}
