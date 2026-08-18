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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('order_id')
                ->constrained('orders')
                ->cascadeOnDelete();

            $table->foreignId('product_id')
                ->constrained('products')
                ->restrictOnDelete();

            $table->foreignId('product_variation_id')
                ->nullable()
                ->constrained('product_variations')
                ->nullOnDelete();

            $table->string('product_name');
            $table->string('sku')->nullable();

            $table->unsignedInteger('qty');

            $table->decimal('price', 10, 2);
            $table->decimal('subtotal', 10, 2);

            $table->enum('fulfillment_status', [
                'pending',
                'packed',
                'shipped',
                'delivered'
            ])->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
