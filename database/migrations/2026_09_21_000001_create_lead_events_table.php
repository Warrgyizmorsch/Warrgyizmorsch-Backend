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
        if (!Schema::hasTable('lead_events')) {
            Schema::create('lead_events', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('lead_id');
                $table->string('event_type', 50); // meeting_schedule, discovery_call, projection_call, conversion
                $table->date('event_date');
                $table->time('start_time');
                $table->time('end_time')->nullable();
                $table->unsignedBigInteger('assigned_to')->nullable();
                $table->string('title')->nullable();
                $table->text('description')->nullable();
                $table->string('status', 30)->default('scheduled'); // scheduled, completed, cancelled, rescheduled
                $table->timestamp('completed_at')->nullable();
                $table->unsignedBigInteger('created_by')->nullable();
                $table->timestamps();

                // Optimized lookup indexes
                $table->index(['lead_id', 'status']);
                $table->index(['event_date', 'status']);
                $table->index(['assigned_to', 'status']);
                $table->index('event_type');

                // Foreign keys matching CRM convention
                $table->foreign('lead_id')->references('id')->on('leads')->onDelete('cascade');
                $table->foreign('assigned_to')->references('id')->on('users')->onDelete('set null');
                $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lead_events');
    }
};
