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
    Schema::create('customers', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->unsignedBigInteger('area_id');
        $table->string('address');
        $table->unsignedBigInteger('plan_id');
        $table->date('lpd')->nullable();
        $table->text('remarks')->nullable();
        $table->timestamps();

        $table->foreign('area_id')->references('id')->on('areas')->cascadeOnDelete();
        $table->foreign('plan_id')->references('id')->on('plans')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
