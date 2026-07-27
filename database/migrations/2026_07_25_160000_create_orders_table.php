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
        if (!Schema::hasTable('orders')) {
            Schema::create('orders', function (Blueprint $table) {
                $table->id();
                $table->string('order_number')->unique();
                $table->unsignedBigInteger('lead_id')->nullable();
                $table->unsignedBigInteger('uid')->nullable();
                $table->unsignedBigInteger('order_bucket_id')->nullable();
                $table->string('order_status')->nullable();
                $table->string('order_engagement_status')->nullable();
                $table->unsignedBigInteger('order_owner')->nullable();
                $table->unsignedBigInteger('converted_by')->nullable();
                $table->unsignedBigInteger('category_id')->nullable();
                $table->string('product')->nullable();
                $table->json('services')->nullable();
                $table->text('pain_points')->nullable();
                $table->json('client_details')->nullable();
                $table->json('documents')->nullable();
                $table->decimal('amount', 12, 2)->default(0);
                $table->text('notes')->nullable();
                $table->timestamp('converted_at')->nullable();
                $table->tinyInteger('is_active')->default(1);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
