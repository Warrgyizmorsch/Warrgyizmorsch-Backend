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
            if (!Schema::hasColumn('leads', 'address')) {
                $table->text('address')->nullable()->after('city');
            }
            if (!Schema::hasColumn('leads', 'state')) {
                $table->string('state')->nullable()->after('address');
            }
            if (!Schema::hasColumn('leads', 'pincode')) {
                $table->string('pincode')->nullable()->after('state');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            if (Schema::hasColumn('leads', 'address')) {
                $table->dropColumn('address');
            }
            if (Schema::hasColumn('leads', 'state')) {
                $table->dropColumn('state');
            }
            if (Schema::hasColumn('leads', 'pincode')) {
                $table->dropColumn('pincode');
            }
        });
    }
};
