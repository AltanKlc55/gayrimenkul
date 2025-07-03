<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Menu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('title');
            $table->string('slug')->nullable()->unique();
            $table->integer('parent_id')->default(0);
            $table->integer('order')->default(0);
            $table->integer('listening')->default(0);
            $table->integer('status')->default(0);
            $table->integer('type')->default(0);

            $table->integer('image')->default(0);
            $table->integer('image2')->default(0);
            $table->integer('image3')->default(0);
            $table->integer('image4')->default(0);
            $table->integer('image5')->default(0);
            $table->integer('youtube')->default(0);
            $table->decimal('price')->default(0);
            $table->integer('file')->default(0);
            $table->integer('file2')->default(0);
            $table->integer('file3')->default(0);

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
        Schema::dropIfExists('menu');

    }
}