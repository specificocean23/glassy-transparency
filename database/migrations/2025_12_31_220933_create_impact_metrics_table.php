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
        Schema::create('impact_metrics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('initiative_id')->constrained()->onDelete('cascade');
            $table->string('metric_name');
            $table->string('metric_type');
            $table->string('value');
            $table->string('unit')->nullable();
            $table->integer('target_value')->nullable();
            $table->date('measurement_date');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('impact_metrics');
    }
};
