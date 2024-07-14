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
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('booking_vehicle_id')->unsigned();
            $table->decimal('amount', 10, 2);
            $table->timestamp('payment_date')->nullable();
            $table->enum('status', ['pending', 'completed', 'refunded'])->default('pending');
            $table->decimal('refund_amount', 10, 2)->nullable();
            $table->timestamp('refund_date')->nullable();
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('booking_vehicle_id')->references('id')->on('booking_vehicles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
