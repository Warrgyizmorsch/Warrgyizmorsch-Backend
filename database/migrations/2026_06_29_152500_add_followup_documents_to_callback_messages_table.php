<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('callback_messages', function (Blueprint $table) {
            if (!Schema::hasColumn('callback_messages', 'followup_documents')) {
                $table->json('followup_documents')->nullable()->after('call_recording');
            }
        });
    }

    public function down(): void
    {
        Schema::table('callback_messages', function (Blueprint $table) {
            if (Schema::hasColumn('callback_messages', 'followup_documents')) {
                $table->dropColumn('followup_documents');
            }
        });
    }
};
