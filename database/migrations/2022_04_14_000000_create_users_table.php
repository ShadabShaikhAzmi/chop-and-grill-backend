<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role_id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->BigInteger('mobile_number')->unique();
            $table->string('password');
            $table->boolean('is_active')->default(true);
            $table->boolean('is_blocked')->default(false);
            $table->boolean('is_verified')->default(true);
            $table->string('profile')->nullable();
            $table->boolean('is_subscribe')->default(false);
            $table->longText('device_token')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('role_id')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
