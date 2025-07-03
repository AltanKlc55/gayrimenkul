<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductSet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('products_set', function (Blueprint $table) {
            $table->id();
            $table->text('code')->comment('Kod');
            $table->text('title')->comment('Başlık');
            $table->string('slug')->nullable()->unique()->comment('Link');
            $table->string('image')->comment('Resim');
            $table->integer('group')->default(0)->comment('Dönem');
            $table->integer('distributor')->default(0)->comment('Dağıtıcı');

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
        Schema::dropIfExists('products_set');
    }
}