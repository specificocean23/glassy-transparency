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
        Schema::create('spendings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('budget_id')->constrained()->onDelete('cascade');
            $table->foreignId('department_id')->constrained()->onDelete('cascade');
            $table->string('category');
            $table->string('vendor_name')->nullable();
            $table->text('description');
            $table->decimal('amount', 12, 2);
            $table->string('status')->default('approved');
            $table->date('transaction_date');
            $table->string('document_reference')->nullable();
            $table->json('tags')->nullable();
            $table->boolean('is_fossil_fuel_related')->default(false);
            $table->boolean('is_green_energy')->default(false);
            $table->boolean('supports_homelessness_initiative')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spendings');
    }
};
