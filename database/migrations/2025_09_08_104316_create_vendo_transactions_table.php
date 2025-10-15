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
        Schema::create('vendo_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendo_id')->constrained()->onDelete('cascade'); // links to customers
            $table->decimal('amount', 10, 2);
            $table->text('remarks')->nullable(); 
            $table->string('receipt_image')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendo_transactions');
    }
};
