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
        Schema::create('initiatives', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('category');
            $table->decimal('budget', 12, 2);
            $table->decimal('spent', 12, 2)->default(0);
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->string('status')->default('active');
            $table->integer('irish_workers_employed')->default(0);
            $table->text('outcomes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('initiatives');
    }
};
