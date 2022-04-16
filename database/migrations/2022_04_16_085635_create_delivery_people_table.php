<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryPeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_people', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->longText('street');
            $table->string('city');
            $table->string('state');
            $table->integer('pincode');
            $table->string('country');
            $table->bigInteger('aadhar_card');
            $table->string('pan_card')->nullable();
            $table->string('licence')->nullable();
            $table->string('bike_number')->nullable();
            $table->string('rc')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delivery_people');
    }
}
