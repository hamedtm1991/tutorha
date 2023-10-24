<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('store', 100);
            $table->string('status', 100);
            $table->decimal('weight', 10, 2, true)->nullable();
            $table->unsignedBigInteger('price');
            $table->unsignedBigInteger('final_price');
            $table->unsignedBigInteger('total_discount');
            $table->unsignedBigInteger('discount_id')->nullable();
            $table->foreign('discount_id')->references('id')->on('discounts')->onDelete('cascade');
            $table->unsignedBigInteger('total_sale');
            $table->unsignedBigInteger('sale_id')->nullable();
            $table->foreign('sale_id')->references('id')->on('sales')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('description', 400)->nullable();
            $table->timestamps();
        });

        Schema::create('orderables', function (Blueprint $table) {
            $table->unsignedInteger('order_id');
            $table->unsignedInteger('orderable_id');
            $table->string('orderable_type');
            $table->unsignedSmallInteger('quantity');
            $table->unsignedBigInteger('discount');
            $table->unsignedBigInteger('price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orderables');
        Schema::dropIfExists('orders');
    }
};
