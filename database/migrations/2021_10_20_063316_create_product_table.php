<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->string('product_image');
            $table->integer('category_id');
            $table->integer('user_id');
            $table->integer('brand_id');
            $table->integer('product_quantity');
            $table->integer('product_price');
            $table->integer('product_retail_price');
            $table->integer('product_final_price');
            $table->integer('negotiable');
            $table->integer('availability_status');
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
        Schema::dropIfExists('product');
    }
}
