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
        Schema::table('lead_events', function (Blueprint $table) {
            if (!Schema::hasColumn('lead_events', 'google_event_id')) {
                $table->string('google_event_id')->nullable()->after('status')->index();
            }
            if (!Schema::hasColumn('lead_events', 'google_meet_link')) {
                $table->string('google_meet_link', 500)->nullable()->after('google_event_id');
            }
            if (!Schema::hasColumn('lead_events', 'attendees')) {
                $table->text('attendees')->nullable()->after('google_meet_link');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lead_events', function (Blueprint $table) {
            $table->dropColumn(['google_event_id', 'google_meet_link', 'attendees']);
        });
    }
};
