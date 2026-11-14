<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('warr_leads', function (Blueprint $table) {
            $table->string('form_type', 100)->nullable();
            $table->json('form_details')->nullable();
        });

        Schema::table('warr_leads', function (Blueprint $table) {
            $table->string('name')->nullable()->change();
            $table->string('email')->nullable()->change();
        });
    }

    public function down(): void
    {
        DB::table('warr_leads')->whereNull('name')->update(['name' => '']);
        DB::table('warr_leads')->whereNull('email')->update(['email' => '']);

        Schema::table('warr_leads', function (Blueprint $table) {
            $table->string('name')->nullable(false)->change();
            $table->string('email')->nullable(false)->change();
            $table->dropColumn(['form_type', 'form_details']);
        });
    }
};
