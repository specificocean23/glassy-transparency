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
        Schema::create('advocacy_campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('goal');
            $table->longText('description');
            $table->string('status')->default('active'); // active, completed, archived
            $table->integer('petition_count')->default(0);
            $table->integer('target_signatures')->nullable();
            $table->text('call_to_action');
            $table->json('success_metrics')->nullable();
            $table->string('petition_url')->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
            
            $table->index('status');
            $table->index('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advocacy_campaigns');
    }
};
