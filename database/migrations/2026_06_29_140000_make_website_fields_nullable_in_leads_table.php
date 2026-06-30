<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            if (!Schema::hasColumn('leads', 'website')) {
                $table->string('website', 255)->nullable()->after('industry');
            } else {
                $table->string('website', 255)->nullable()->change();
            }

            if (!Schema::hasColumn('leads', 'business_name')) {
                $table->string('business_name', 55)->nullable()->after('website');
            } else {
                $table->string('business_name', 55)->nullable()->change();
            }

            if (!Schema::hasColumn('leads', 'gst_number')) {
                $table->string('gst_number', 55)->nullable()->after('business_name');
            } else {
                $table->string('gst_number', 55)->nullable()->change();
            }
        });
    }

    public function down(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            //
        });
    }
};
