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
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity');
            $table->foreignId('transaction_id')->constrained(
                table: 'transactions',
                indexName: 'transactionDetails_transactions_id'
            );
            $table->foreignId('product_id')->constrained(
                table: 'products',
                indexName: 'transactionDetails_products_id'
            );
            $table->decimal('price', total: 10, places: 0);
            // baru ditambahin
            $table->decimal('subtotal', total: 10, places: 0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_details');
    }
};
