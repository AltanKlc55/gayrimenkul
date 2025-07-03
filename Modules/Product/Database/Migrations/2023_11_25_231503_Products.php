<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Products extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->text('title')->comment('Başlık');;
            $table->text('invoice_title')->comment('Fatura Başlığı');
            $table->string('slug')->nullable()->unique()->comment('Link');
            $table->string('image')->comment('Resim');
            $table->integer('group')->default(0)->comment('Dönem');
            $table->decimal('price', 10, 2)->default(0)->comment('Fiyat');
            $table->integer('vat')->default(0)->comment('KDV');
            $table->integer('stock')->default(0)->comment('Stok');
            $table->integer('unit')->comment('Birim');
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
        Schema::dropIfExists('products');

    }
}