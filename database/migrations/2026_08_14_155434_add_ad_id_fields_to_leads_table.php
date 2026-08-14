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
            if (!Schema::hasColumn('leads', 'campaign_id')) {
                $table->string('campaign_id')->nullable()->after('campaign_name');
            }
            if (!Schema::hasColumn('leads', 'adset_id')) {
                $table->string('adset_id')->nullable()->after('adset_name');
            }
            if (!Schema::hasColumn('leads', 'ad_id')) {
                $table->string('ad_id')->nullable()->after('ad_name');
            }
            if (!Schema::hasColumn('leads', 'form_id')) {
                $table->string('form_id')->nullable()->after('form_name');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->dropColumn(['campaign_id', 'adset_id', 'ad_id', 'form_id']);
        });
    }
};
