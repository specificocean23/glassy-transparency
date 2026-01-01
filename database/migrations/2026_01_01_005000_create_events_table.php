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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('event_type'); // competition, debate, conference, webinar
            $table->longText('description');
            $table->dateTime('start_date');
            $table->dateTime('end_date')->nullable();
            $table->string('location')->nullable(); // physical/virtual
            $table->string('registration_url')->nullable();
            $table->string('recording_url')->nullable();
            $table->integer('max_participants')->nullable();
            $table->string('status')->default('upcoming'); // upcoming, live, completed
            $table->json('featured_speakers')->nullable();
            $table->string('featured_image')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
            
            $table->index('event_type');
            $table->index('status');
            $table->index('start_date');
            $table->index('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
