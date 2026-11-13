<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            if (!Schema::hasColumn('leads', 'is_archived')) {
                $table->boolean('is_archived')->default(0)->after('is_converted')->index();
            }
        });

        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'is_archived')) {
                $table->boolean('is_archived')->default(0)->after('is_active')->index();
            }
        });
    }

    public function down(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            if (Schema::hasColumn('leads', 'is_archived')) {
                $table->dropColumn('is_archived');
            }
        });

        Schema::table('orders', function (Blueprint $table) {
            if (Schema::hasColumn('orders', 'is_archived')) {
                $table->dropColumn('is_archived');
            }
        });
    }
};
