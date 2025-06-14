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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->date('purchase_date');
            $table->string('invoice_number')->unique();
            $table->foreignId('supplier_id')->constrained(
                table: 'suppliers',
                indexName: 'purchases_suppliers_id'
            );
            $table->text('notes')->nullable();
            $table->decimal('total_amount', 10, 0);
            $table->decimal('tax', 10, 0)->nullable();
            $table->foreignId('user_id')->constrained(
                table: 'users',
                indexName: 'purchases_users_id'
            );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
