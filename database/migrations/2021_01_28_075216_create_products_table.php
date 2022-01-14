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
            $table->uuid('id')->primary();
            $table->uuid('product_id');
            $table->string('product_type');
            $table->uuid('brand_id');
            $table->uuid('category_id');
            $table->uuid('sub_category_id')->nullable();
            $table->uuid('sub_sub_category_id')->nullable();
            $table->string('sku')->unique();
            $table->string('name')->unique();
            $table->string('slug');
            $table->string('model')->nullable();
            $table->string('part_number')->nullable();
            $table->longText('description')->nullable()->default('No Technical(Particular) Given');
            $table->longText('details')->nullable()->default('No General Specifications Given');
            $table->double('old_cost')->default(0.00);
            $table->double('new_cost')->default(0.00);
            $table->double('buying_price')->default(0.00);
            $table->double('selling_price')->default(0.00);
            $table->string('weight_unit')->nullable();
            $table->double('weight_value')->default(0);
            $table->string('processor')->nullable();
            $table->string('hard_drive')->nullable();
            $table->string('hard_drive_type')->nullable();
            $table->string('memory')->nullable();
            $table->string('operating_system')->nullable();
            $table->integer('available_quantity')->default(0);
            $table->integer('reordering_level')->default(0);
            $table->jsonb('part_names')->default(json_encode(array()));
            $table->jsonb('sizes')->default(json_encode(array()));
            $table->jsonb('colors')->default(json_encode(array()));
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
        Schema::dropIfExists('products');
    }
}
