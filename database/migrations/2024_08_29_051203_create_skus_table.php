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
        Schema::create('skus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->string('sku')->unique()->nullable();
            $table->string('barcode')->unique()->nullable();
            $table->unsignedBigInteger('quantity')->default(0);
            $table->boolean('stock_visibility')->default(false);
            $table->unsignedBigInteger('stock_alert')->default(0);
            $table->unsignedBigInteger('old_price')->nullable();
            $table->unsignedBigInteger('price')->nullable();
            $table->unsignedBigInteger('cost')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skus');
    }
};
