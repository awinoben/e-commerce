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
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->string('payment_option_id');
            $table->smallInteger('quantity')->default(0);
            $table->double('sub_cost')->default(0.00);
            $table->string('order_number')->unique();
            $table->boolean('is_dispatched')->default(false);
            $table->boolean('is_cancelled')->default(false);
            $table->boolean('is_received')->default(false);
            $table->boolean('is_paid')->default(false);
            $table->boolean('is_payment_dispatched')->default(false);
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
        Schema::dropIfExists('orders');
    }
}
