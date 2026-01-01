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
        Schema::create('sea_level_projections', function (Blueprint $table) {
            $table->id();
            $table->string('region'); // Dublin Bay, Cork Harbor, Galway, etc.
            $table->decimal('year_2030', 8, 2); // cm
            $table->decimal('year_2050', 8, 2); // cm
            $table->decimal('year_2100', 8, 2); // cm
            $table->decimal('affected_area_km2', 10, 2)->nullable();
            $table->integer('population_at_risk')->nullable();
            $table->decimal('economic_value_at_risk', 15, 2)->nullable(); // euros
            $table->text('description')->nullable();
            $table->json('coordinates')->nullable(); // For map display
            $table->timestamps();
            
            $table->index('region');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sea_level_projections');
    }
};
