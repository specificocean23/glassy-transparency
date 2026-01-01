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
        Schema::create('environmental_metrics', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('metric_type'); // co2_equivalent, sea_level, biodiversity, etc.
            $table->decimal('value', 15, 2);
            $table->string('unit'); // football_pitches, tonnes_co2, hectares, etc.
            $table->integer('reference_year');
            $table->string('data_source');
            $table->text('description');
            $table->json('visual_representation')->nullable(); // Chart data
            $table->string('region')->default('Ireland'); // Ireland-wide, Cork, Dublin, etc.
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
            
            $table->index(['metric_type', 'region']);
            $table->index('reference_year');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('environmental_metrics');
    }
};
