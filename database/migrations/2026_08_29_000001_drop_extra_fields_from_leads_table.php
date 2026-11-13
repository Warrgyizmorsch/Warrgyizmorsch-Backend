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
        Schema::table('leads', function (Blueprint $table) {
            $columnsToDrop = [];

            if (Schema::hasColumn('leads', 'lead_data')) {
                $columnsToDrop[] = 'lead_data';
            }
            if (Schema::hasColumn('leads', 'company_name')) {
                $columnsToDrop[] = 'company_name';
            }
            if (Schema::hasColumn('leads', 'category')) {
                $columnsToDrop[] = 'category';
            }

            if (!empty($columnsToDrop)) {
                $table->dropColumn($columnsToDrop);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->longText('lead_data')->nullable();
            $table->text('company_name')->nullable();
            $table->string('category')->nullable();
        });
    }
};
