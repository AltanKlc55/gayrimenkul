<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Offers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->integer('current_id')->default(0)->comment('Cari No');
            $table->string('offer_id')->comment('Teklif No');
            $table->text('title')->comment('Teklif Adı');
            $table->integer('status')->default(0)->comment('Durum');
            $table->integer('person_id')->default(0)->comment('Oluşturan');
            $table->integer('offer_design')->comment('Fatura Şablonu');
            $table->text('offer_note')->comment('Fatura Notu');
            $table->date('date_issued')->comment('Veriliş Tarihi');
            $table->date('due_date')->comment('Bitiş Tarihi');

            $table->date('is_brand')->comment('Marka Gözüksün Mü');
            $table->date('is_works')->comment('İşçilik Gözüksün Mü');

            $table->decimal('price', 20, 3)->default(0)->comment('Fiyat');

            $table->decimal('usd', 10, 3)->default(0)->comment('Usd');
            $table->decimal('euro', 10, 3)->default(0)->comment('Euro');
            $table->decimal('parite', 10, 3)->default(0)->comment('Parite');
            

            $table->integer('vat')->default(0)->comment('KDV');
            $table->integer('auth')->default(0)->comment('Ekleyen');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->timestamp('deleted_at')->nullable();
        });
        Schema::create('offer_child', function (Blueprint $table) {
            $table->id();
            $table->string('offer_id')->comment('Teklif No');
            $table->integer('product')->comment('ürün');
            $table->text('title')->comment('İçerik');
            $table->integer('qty')->comment('Adet');
            $table->decimal('price', 30, 2)->default(0)->comment('Fiyat');
            $table->integer('vat')->default(0)->comment('KDV');
            $table->integer('currency')->comment('Para Birimi');
            $table->integer('store')->comment('Depo');


            $table->timestamp('delivery_at')->nullable();
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
        Schema::dropIfExists('offers');
        Schema::dropIfExists('offer_child');

    }
}
