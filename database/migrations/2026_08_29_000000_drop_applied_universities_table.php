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
        Schema::dropIfExists('applied_universities');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('applied_universities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lead_id')->nullable();
            $table->unsignedBigInteger('university_id')->nullable();
            $table->unsignedBigInteger('course_id')->nullable();
            $table->string('status')->default('applied');
            $table->date('applied_date')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }
};
