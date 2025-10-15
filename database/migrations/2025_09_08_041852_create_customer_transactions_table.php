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
        Schema::create('customer_transactions', function (Blueprint $table) {
        $table->id();
        $table->foreignId('customer_id')->constrained()->onDelete('cascade'); // links to customers
        $table->decimal('amount', 10, 2); // payment amount
        $table->string('payment_method')->nullable(); // e.g., cash, card, online
        $table->text('remarks')->nullable(); // optional notes
        $table->string('receipt_number')->unique();
        $table->string('receipt_image')->nullable(); // path for uploaded receipt image
        $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_transactions');
    }
};
