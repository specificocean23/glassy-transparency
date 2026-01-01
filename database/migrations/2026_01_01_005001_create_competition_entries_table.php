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
        Schema::create('competition_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->onDelete('cascade'); // Links to events table
            $table->string('team_name');
            $table->string('institution');
            $table->string('lead_researcher');
            $table->string('contact_email');
            $table->string('project_title');
            $table->text('abstract');
            $table->string('submission_url')->nullable(); // PDF/document link
            $table->string('status')->default('submitted'); // submitted, under_review, winner, finalist
            $table->decimal('score', 5, 2)->nullable();
            $table->text('judge_feedback')->nullable();
            $table->timestamps();
            
            $table->index('event_id');
            $table->index('status');
            $table->index('institution');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competition_entries');
    }
};
