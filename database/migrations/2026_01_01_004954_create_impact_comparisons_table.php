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
        Schema::create('impact_comparisons', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('subject_type'); // power_station, project, sector
            $table->string('subject_name');
            $table->decimal('co2_tonnes', 15, 2);
            $table->integer('equivalent_cars')->nullable();
            $table->integer('equivalent_trees_needed')->nullable();
            $table->decimal('equivalent_area_flooded', 10, 2)->nullable(); // in hectares
            $table->text('visual_metaphor');
            $table->json('data_sources');
            $table->integer('year');
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
            
            $table->index('subject_type');
            $table->index('year');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('impact_comparisons');
    }
};
