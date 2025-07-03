<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductBuyying extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_buyying', function (Blueprint $table) {
            $table->id();
            $table->text('code')->comment('Kod');
            $table->text('title')->comment('Başlık');
            $table->text('supplier')->comment('Tedarikçi');
            $table->integer('group')->default(0)->comment('Gider Grubu');
            $table->integer('sub_group')->default(0)->comment('Gider Türü');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->timestamp('deleted_at')->nullable();
        });

        Schema::create('products_buyying_child', function (Blueprint $table) {
            $table->id();
            $table->text('code')->comment('Kod');
            $table->integer('product')->comment('Ürün');
            $table->integer('qty')->comment('Adet');
            $table->float('price')->default(0)->comment('Fiyat');

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
        Schema::dropIfExists('products_buyying');
        Schema::dropIfExists('products_buyying_child');
    }
}
