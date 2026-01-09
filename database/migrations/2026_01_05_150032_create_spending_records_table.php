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
        Schema::create('spending_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('financial_category_id')->constrained()->onDelete('cascade');
            $table->foreignId('county_id')->constrained()->onDelete('cascade');
            $table->integer('year');
            $table->decimal('amount', 15, 2); // in euros
            $table->text('notes')->nullable();
            $table->timestamps();
            
            // Ensure unique combination of category, county, and year
            $table->unique(['financial_category_id', 'county_id', 'year']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spending_records');
    }
};
