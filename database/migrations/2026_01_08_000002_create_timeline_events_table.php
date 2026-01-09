<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('timeline_events', function (Blueprint $table) {
            $table->id();
            $table->date('event_date');
            $table->string('title');
            $table->text('description');
            $table->string('event_type'); // 'income', 'expense', 'policy', 'scandal'
            $table->decimal('amount', 15, 2)->nullable();
            $table->string('category')->nullable(); // e.g., 'Infrastructure', 'Tax Revenue', 'Waste'
            $table->string('department')->nullable();
            $table->string('source_url')->nullable();
            $table->string('impact_level')->default('medium'); // low, medium, high, critical
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_controversial')->default(false);
            $table->json('tags')->nullable();
            $table->text('media_coverage')->nullable();
            $table->timestamps();
            
            $table->index('event_date');
            $table->index('event_type');
            $table->index('is_featured');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('timeline_events');
    }
};
