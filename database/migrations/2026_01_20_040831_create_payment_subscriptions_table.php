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
        Schema::create('payment_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('user_list')->onDelete('cascade');
            $table->foreignId('app_id')->constrained('app_models')->onDelete('cascade');
            $table->foreignId('plan_id')->constrained('payments')->cascadeOnDelete();
            $table->string('status')->default('active');
            $table->unique(['user_id', 'app_id', 'plan_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_subscriptions');
    }
};
