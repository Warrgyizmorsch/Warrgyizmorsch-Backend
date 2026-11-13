<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('plugin_settings')) {
            Schema::create('plugin_settings', function (Blueprint $table) {
                $table->id();
                $table->string('plugin_key')->unique();
                $table->string('name');
                $table->string('category')->default('communication');
                $table->text('description')->nullable();
                $table->boolean('is_active')->default(true);
                $table->json('settings')->nullable();
                $table->unsignedBigInteger('created_by')->nullable();
                $table->unsignedBigInteger('updated_by')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('plugin_settings');
    }
};
