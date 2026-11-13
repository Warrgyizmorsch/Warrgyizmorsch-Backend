<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('todo_tasks')) {
            try {
                DB::statement("ALTER TABLE `todo_tasks` MODIFY COLUMN `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT");
            } catch (\Throwable $e) {
                try {
                    DB::statement("ALTER TABLE `todo_tasks` ADD PRIMARY KEY (`id`), MODIFY COLUMN `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT");
                } catch (\Throwable $e2) {
                    // Fallback if index already exists
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
