<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('revenue_streams', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('title');
            $table->text('description')->nullable();
            $table->decimal('amount', 15, 2);
            $table->string('source_type'); // 'tax', 'fine', 'settlement', 'grant', 'investment'
            $table->string('source_name');
            $table->string('category')->nullable();
            $table->boolean('is_recurring')->default(false);
            $table->string('frequency')->nullable(); // 'one-time', 'monthly', 'quarterly', 'annual'
            $table->text('conditions')->nullable();
            $table->timestamps();
            
            $table->index('date');
            $table->index('source_type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('revenue_streams');
    }
};
