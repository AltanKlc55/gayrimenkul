<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Collection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collection', function (Blueprint $table) {
            $table->id();
            $table->integer('current_id')->default(0)->comment('Cari No');
            $table->text('title')->comment('Tahsilat Başlık');
            $table->longText('desc')->comment('Açıklama');

            $table->integer('type')->default(0)->comment('Tür');
            $table->integer('status')->default(0)->comment('Durum');
            $table->integer('period')->default(0)->comment('Durum');
            $table->integer('project')->default(0)->comment('Durum');
            $table->decimal('amount', 30, 2)->default(0)->comment('Fiyat');
            $table->integer('vat')->default(0)->comment('KDV');
            $table->integer('payment_at')->default(0)->comment('Tahsilat Tarih');
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
        Schema::dropIfExists('collection');

    }
}
