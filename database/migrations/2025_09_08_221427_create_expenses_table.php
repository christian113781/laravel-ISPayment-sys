<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id(); // id
            $table->date('expenses_date'); // expense date
            $table->string('type'); // category
            $table->decimal('amount', 15, 2); // expense amount
            $table->text('description')->nullable(); // details about expense
            $table->string('receipt_image')->nullable(); // Image of receipt
            $table->timestamps(); // created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
