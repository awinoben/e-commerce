<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_images', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('product_id');
            $table->string('front_image')->nullable();
            $table->string('front_image_url')->nullable();
            $table->string('back_image')->nullable();
            $table->string('back_image_url')->nullable();
            $table->string('left_image')->nullable();
            $table->string('left_image_url')->nullable();
            $table->string('right_image')->nullable();
            $table->string('right_image_url')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('product_images');
    }
}
