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
        Schema::dropIfExists('transactions');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->enum('transaction_type', ['in', 'out']);
            $table->foreignId('partner_id')->constrained(
                table: 'partners',
                indexName: 'transactions_partners_id'
            );
            $table->foreignId('user_id')->constrained(
                table: 'users',
                indexName: 'transactions_users_id'
            );
            $table->decimal('total_amount', 10, 0);
            $table->decimal('tax', 10, 0)->nullable();
            $table->string('invoice_number')->unique();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }
};
