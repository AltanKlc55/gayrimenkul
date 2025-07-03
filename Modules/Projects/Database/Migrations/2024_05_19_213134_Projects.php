<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Projects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->integer('current_id')->default(0)->comment('Cari No');
            $table->string('project_id')->comment('Proje No');
            $table->text('title')->comment('Proje Adı');
            $table->integer('status')->default(0)->comment('Durum');
            $table->integer('person_id')->default(0)->comment('Oluşturan');
            $table->text('project_note')->comment('Proje Notu');
            $table->text('project_items')->comment('Proje Maddeleri');
            $table->string('project_manager')->comment('Proje Yöneticisi');
            $table->string('project_persons')->comment('Proje Çalışanları');
            $table->decimal('price', 10, 2)->default(0)->comment('Fiyat');
            $table->integer('vat')->default(0)->comment('KDV');
            $table->integer('auth')->default(0)->comment('Ekleyen');
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
        //
    }
}
