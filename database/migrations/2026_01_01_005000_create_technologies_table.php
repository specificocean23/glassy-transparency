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
        Schema::create('technologies', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // VRFB, Li-ion Battery, etc.
            $table->string('slug')->unique();
            $table->string('category'); // storage, generation, grid
            $table->text('description');
            $table->json('technical_specs')->nullable();
            $table->text('advantages')->nullable();
            $table->text('disadvantages')->nullable();
            $table->text('irish_applications')->nullable();
            $table->decimal('cost_per_kwh', 10, 2)->nullable();
            $table->integer('lifespan_years')->nullable();
            $table->decimal('efficiency_percent', 5, 2)->nullable();
            $table->string('featured_image')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
            
            $table->index('category');
            $table->index('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('technologies');
    }
};
