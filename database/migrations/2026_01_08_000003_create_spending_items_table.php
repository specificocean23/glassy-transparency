<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('spending_items', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('title');
            $table->text('description')->nullable();
            $table->decimal('amount', 15, 2);
            $table->string('category');
            $table->string('department')->nullable();
            $table->string('vendor')->nullable();
            $table->string('location')->nullable();
            $table->string('procurement_method')->nullable();
            $table->string('status')->default('completed'); // planned, ongoing, completed, cancelled
            $table->text('justification')->nullable();
            $table->string('source_document')->nullable();
            $table->boolean('is_questionable')->default(false);
            $table->integer('public_interest_score')->default(0); // 0-100
            $table->timestamps();
            
            $table->index('date');
            $table->index('category');
            $table->index('is_questionable');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('spending_items');
    }
};
