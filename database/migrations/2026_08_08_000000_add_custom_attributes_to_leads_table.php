<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations to add custom_attributes column to leads table.
     */
    public function up(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            // Adding a nullable JSON column to store any extra unmapped Excel data
            $table->json('custom_attributes')->nullable()->after('documents');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->dropColumn('custom_attributes');
        });
    }
};
