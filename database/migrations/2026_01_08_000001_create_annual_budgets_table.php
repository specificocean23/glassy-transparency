<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('annual_budgets', function (Blueprint $table) {
            $table->id();
            $table->integer('year');
            $table->string('category'); // e.g., 'Health', 'Education', 'Infrastructure', etc.
            $table->string('department')->nullable();
            $table->decimal('allocated_amount', 15, 2);
            $table->decimal('spent_amount', 15, 2)->default(0);
            $table->decimal('predicted_amount', 15, 2)->nullable();
            $table->string('status')->default('active'); // active, completed, overbudget
            $table->string('source')->nullable(); // where the data came from
            $table->text('notes')->nullable();
            $table->timestamps();
            
            $table->index(['year', 'category']);
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('annual_budgets');
    }
};
