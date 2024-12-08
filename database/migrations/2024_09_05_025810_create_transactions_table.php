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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->enum('transaction_type', ['in', 'out']);
            $table->timestamp('created_at');
            $table->foreignId('partner_id')->constrained(
                table: 'partners',
                indexName: 'products_partners_id'
            );
            $table->foreignId('user_id')->constrained(
                table: 'users',
                indexName: 'products_users_id'
            );
            $table->decimal('totalAmount', total: 10, places: 0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
