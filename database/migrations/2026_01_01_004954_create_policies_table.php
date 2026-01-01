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
        Schema::create('policies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('policy_type'); // legislation, target, strategy
            $table->string('status')->default('proposed'); // proposed, active, abandoned
            $table->text('description');
            $table->date('introduced_date')->nullable();
            $table->date('target_completion_date')->nullable();
            $table->foreignId('department_id')->nullable()->constrained()->nullOnDelete();
            $table->boolean('eu_mandate')->default(false);
            $table->text('impact_assessment')->nullable();
            $table->string('document_url')->nullable();
            $table->json('key_metrics')->nullable(); // targets, KPIs
            $table->timestamps();
            
            $table->index('policy_type');
            $table->index('status');
            $table->index('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('policies');
    }
};
