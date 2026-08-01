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
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'state')) {
                $table->string('state')->nullable()->after('city');
            }
            if (!Schema::hasColumn('users', 'pincode')) {
                $table->string('pincode')->nullable()->after('state');
            }
            if (!Schema::hasColumn('users', 'address')) {
                $table->text('address')->nullable()->after('pincode');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'address')) {
                $table->dropColumn('address');
            }
            if (Schema::hasColumn('users', 'pincode')) {
                $table->dropColumn('pincode');
            }
            if (Schema::hasColumn('users', 'state')) {
                $table->dropColumn('state');
            }
        });
    }
};
