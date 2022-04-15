<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('categories_id');
            $table->string('product_code')->unique();
            $table->string('slug')->unique();
            $table->string('product_name');
            $table->decimal('price');
            $table->decimal('mrp');
            $table->string('description');
            $table->string('units');
            $table->decimal('gross');
            $table->decimal('net');
            $table->float('pieces')->nullable();
            $table->integer('qty');
            $table->boolean('is_active');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('categories_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
