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
        Schema::create('purchase_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained(
                table: 'products',
                indexName: 'purchases_details_products_id'
            );
            $table->integer('quantity');
            $table->decimal('price', 10, 0);
            $table->foreignId('purchase_id')->constrained(
                table: 'purchases',
                indexName: 'purchases_details_purchases_id'
            )->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_details');
    }
};
