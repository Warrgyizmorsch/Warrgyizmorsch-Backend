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
        Schema::create('seo_leads', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone_number')->nullable();
            $table->text('website_url')->nullable();
            $table->text('interested_services')->nullable();
            $table->string('monthly_spend')->nullable();
            $table->text('growth_goal')->nullable();
            $table->string('status')->default('new');
            $table->boolean('is_converted')->default(false);
            $table->unsignedBigInteger('converted_lead_id')->nullable();
            $table->timestamp('converted_at')->nullable();
            $table->timestamps();

            $table->index('is_converted');
            $table->index('status');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seo_leads');
    }
};
