<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Bill extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type')->nullable()->comment('Tür');
            $table->integer('bill_no')->nullable()->comment('Çek no');
            $table->integer('account_number')->nullable()->comment('Hesap no');
            $table->integer('variety')->nullable()->default(0)->comment('Çeşit');
            $table->integer('current_id')->nullable()->default(0);
            $table->decimal('amount',30,2)->default(0)->nullable()->comment('Tutar');
            $table->float('tax')->default(0)->nullable()->comment('Kdv');
            $table->integer('unit')->default(0)->nullable()->comment('PAra Birimi');
            $table->decimal('real_amount',30,2)->default(0)->nullable()->comment('Gerçek Tutar');
            $table->decimal('usd',30,2)->default(0)->nullable()->comment('USD');
            $table->decimal('euro',30,2)->default(0)->nullable()->comment('Euro');
            $table->decimal('parite',30,2)->default(0)->nullable()->comment('Parite');
            $table->string('bank')->default(0)->comment('Banka');
            $table->string('branch')->default(0)->nullable()->comment('Şube');
            $table->string('province')->default(0)->nullable()->comment('İl');
            $table->string('district')->default(0)->nullable()->comment('ilçe');
            $table->date('process_date')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('İşlem Tarihi');
            $table->date('maturity_date')->nullable()->comment('Vade Tarihi');
            $table->integer('status')->nullable()->default(0);
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
        Schema::dropIfExists('bill');
    }
}
