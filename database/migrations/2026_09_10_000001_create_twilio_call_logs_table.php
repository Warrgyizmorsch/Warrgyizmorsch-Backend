<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('twilio_call_logs')) {
            Schema::create('twilio_call_logs', function (Blueprint $table) {
                $table->id();
                $table->string('call_sid', 100)->nullable()->index();
                $table->string('direction', 50)->default('outbound'); // outbound | inbound
                $table->string('status', 50)->default('initiated');   // initiated | ringing | in-progress | completed | missed | no-answer | failed | cancelled
                $table->string('from_number', 50)->nullable();
                $table->string('to_number', 50)->nullable();
                $table->string('customer_name', 191)->nullable();
                $table->integer('duration')->default(0);              // Call duration in seconds
                $table->unsignedBigInteger('agent_user_id')->nullable();
                $table->foreign('agent_user_id')->references('id')->on('users')->nullOnDelete();
                $table->string('agent_identity', 100)->nullable();   // e.g. agent_1
                $table->timestamp('started_at')->nullable();
                $table->timestamp('ended_at')->nullable();
                $table->text('notes')->nullable();
                $table->text('recording_url')->nullable();           // Twilio recording MP3 URL
                $table->string('recording_sid', 100)->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('twilio_call_logs');
    }
};
