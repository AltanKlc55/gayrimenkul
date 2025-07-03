<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Order extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->string('orderid',20);
            $table->integer('payment_status')->default(0);
            $table->integer('product')->default(0);
            $table->integer('semester')->default(0);
            $table->decimal('paid_total', 10, 2)->default(0)->comment('Fiyat');
            $table->integer('vat')->default(0);
            $table->string('name');
            $table->string('student');
            $table->string('idenity');
            $table->string('phone');
            $table->string('email');
            $table->text('address');
            $table->string('installments')->comment('Taksit');
            $table->string('invoice_no');
            $table->text('delivery_note');
            $table->string('delivery_person');
            $table->string('delivery_code');
            $table->timestamp('delivery_at')->nullable();
            $table->timestamp('invoice_at')->nullable();
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
        Schema::dropIfExists('order');

    }
}
