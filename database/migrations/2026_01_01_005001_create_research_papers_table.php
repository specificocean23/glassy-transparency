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
        Schema::create('research_papers', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('authors');
            $table->date('publication_date');
            $table->string('journal_name')->nullable();
            $table->text('abstract');
            $table->string('pdf_url')->nullable();
            $table->string('doi')->nullable();
            $table->json('keywords')->nullable();
            $table->foreignId('technology_id')->nullable()->constrained()->nullOnDelete();
            $table->integer('citations_count')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
            
            $table->index('publication_date');
            $table->index('technology_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('research_papers');
    }
};
