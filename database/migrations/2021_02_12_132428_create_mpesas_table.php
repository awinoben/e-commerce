<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMpesasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mpesas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id')->nullable();
            $table->uuid('order_id')->nullable();
            $table->string('reference_number')->unique();
            $table->string('transaction_number')->nullable()->unique();
            $table->string('phone_number');
            $table->string('description');
            $table->double('amount')->default(0.00);
            $table->jsonb('payload')->nullable();
            $table->jsonb('options')->nullable();
            $table->tinyInteger('attempts')->default(0);
            $table->boolean('is_paid')->default(false);
            $table->boolean('is_withdrawn')->default(false);
            $table->boolean('is_successful')->default(false);
            $table->boolean('is_initiated')->default(false);
            $table->timestamp('queued_at');
            $table->timestamp('callback_received_at')->nullable();
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
        Schema::dropIfExists('mpesas');
    }
}
