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
        // Check if columns don't already exist
        if (!Schema::hasColumn('users', 'oauth_provider')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('oauth_provider')->nullable()->after('password');
                $table->string('oauth_id')->nullable()->after('oauth_provider');
                $table->unique(['oauth_provider', 'oauth_id'])->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'oauth_provider')) {
                $table->dropColumn('oauth_provider');
            }
            if (Schema::hasColumn('users', 'oauth_id')) {
                $table->dropColumn('oauth_id');
            }
        });
    }
};
