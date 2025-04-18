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
        Schema::create('payment_histories', function (Blueprint $table) {
            $table->id();
            $table->string('user_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('payslip_image')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('order_code')->nullable();
            $table->string('total_amt')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_histories');
    }
};
