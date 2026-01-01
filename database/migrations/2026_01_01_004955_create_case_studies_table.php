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
        Schema::create('case_studies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category'); // jobs, energy_security, cost_savings, environmental
            $table->string('location'); // Dublin, Cork, Ireland-wide, etc.
            $table->text('summary');
            $table->longText('full_content'); // Rich text
            $table->integer('jobs_created')->nullable();
            $table->decimal('investment_amount', 15, 2)->nullable();
            $table->decimal('co2_reduced', 12, 2)->nullable(); // tonnes
            $table->decimal('energy_generated_mwh', 12, 2)->nullable();
            $table->string('featured_image')->nullable();
            $table->json('key_stats')->nullable(); // Flexible stats array
            $table->foreignId('initiative_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamp('published_at')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
            
            $table->index('category');
            $table->index('location');
            $table->index('slug');
            $table->index('published_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('case_studies');
    }
};
