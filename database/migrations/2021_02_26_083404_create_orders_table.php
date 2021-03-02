<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->comment('user_id=customer_id')->unsigned();
            $table->integer('shipping_id')->unsigned();
            $table->integer('payment_id')->unsigned();
            $table->integer('order_no');
            $table->double('order_total');
            $table->tinyInteger('status')->default(0)->comment('0=Pending, 1=Approved');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
