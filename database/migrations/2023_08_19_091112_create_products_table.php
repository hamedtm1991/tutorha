<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100)->unique();
            $table->string('description', 500);
            $table->text('long_description')->nullable();
            $table->unsignedBigInteger('price');
            $table->unsignedBigInteger('fake_price')->nullable();
            $table->json('options')->nullable();
            $table->timestamps();
        });

        Schema::create('episodes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->string('title');
            $table->string('group');
            $table->json('links');
            $table->string('time', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('episodes');
        Schema::dropIfExists('products');
    }
};
