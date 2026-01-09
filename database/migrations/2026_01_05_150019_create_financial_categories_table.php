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
        Schema::create('financial_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., "Fossil Fuels (Gas for Energy)"
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('icon')->nullable(); // emoji or icon class
            $table->string('color', 7)->default('#3b82f6'); // hex color for pie chart
            $table->boolean('is_environmental_positive')->default(false); // good for environment
            $table->boolean('is_environmental_negative')->default(false); // bad for environment
            $table->boolean('is_new_housing')->default(false);
            $table->boolean('is_current_housing')->default(false);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financial_categories');
    }
};
