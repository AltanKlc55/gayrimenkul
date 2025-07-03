<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Content extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('set foreign_key_checks=0');

      Schema::create('content', function (Blueprint $table) {

            $table->engine = 'InnoDB';

            $table->id();
            $table->text('title');
            $table->text('description');
            $table->text('single');

            $table->string('slug')->nullable()->unique();
            $table->integer('menu_id')->unsigned();
            $table->integer('order')->default(0);
            $table->integer('status')->default(0);
            $table->integer('type')->default(0);
            $table->string('image')->nullable();
            $table->string('image2')->nullable();
            $table->string('image3')->nullable();
            $table->string('image4')->nullable();
            $table->string('image5')->nullable();
            $table->text('youtube')->nullable();
            $table->decimal('price',10,2)->nullable();
            $table->decimal('discount',10,2)->nullable();
            $table->string('file')->nullable();
            $table->string('file2')->nullable();
            $table->string('file3')->nullable();

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->timestamp('deleted_at')->nullable();
            $table->foreign('menu_id')->references('id')->on('menu')->onDelete('cascade');

        });
        Schema::create('content_media', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->id();
            $table->string('media')->nullable();
            $table->foreignId('parrent_id')->constrained('content')->onDelete('cascade');;
            $table->integer('order')->default(0);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->timestamp('deleted_at')->nullable();
        });
        Schema::create('content_image', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();

            $table->string('image')->nullable();
            $table->foreignId('parrent_id')->constrained('content')->onDelete('cascade');;
            $table->integer('order')->default(0);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->timestamp('deleted_at')->nullable();

        });
        DB::statement('set foreign_key_checks=1');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('content');
        Schema::dropIfExists('content_media');
        Schema::dropIfExists('content_image');

    }
}