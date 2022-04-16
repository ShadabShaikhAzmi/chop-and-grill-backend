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
            $table->string('order_code')->unique();
            $table->unsignedBigInteger('user_id');
            $table->double('total_amount');
            $table->double('tax_rate');
            $table->double('delivery_charge');
            $table->double('discount');
            $table->unsignedBigInteger('coupon_code_id');
            $table->unsignedBigInteger('shipping_id');
            $table->unsignedBigInteger('billing_id');
            $table->boolean('status')->default(false);
            $table->datetime('assign_time_date');
            $table->unsignedBigInteger('assign_to');
            $table->timestamps();


            $table->foreign('coupon_code_id')->references('id')->on('coupons');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('assign_to')->references('id')->on('users');
            $table->foreign('shipping_id')->references('id')->on('addresses');
            $table->foreign('billing_id')->references('id')->on('addresses');
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
