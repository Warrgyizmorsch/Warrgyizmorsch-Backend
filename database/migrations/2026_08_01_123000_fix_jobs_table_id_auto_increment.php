<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('jobs')) {
            try {
                DB::statement("ALTER TABLE `jobs` MODIFY `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT;");
            } catch (\Throwable $e) {
                // Ignore if already auto-increment or failing
            }
        }

        if (Schema::hasTable('lead_import_jobs')) {
            try {
                DB::statement("ALTER TABLE `lead_import_jobs` MODIFY `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT;");
            } catch (\Throwable $e) {
                // Ignore if already auto-increment
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
