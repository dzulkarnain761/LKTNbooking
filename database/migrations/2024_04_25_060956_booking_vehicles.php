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
        Schema::create('booking_vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('vehicle_type');
            $table->string('task');
            $table->string('state');
            $table->string('district');
            $table->string('location');
            $table->string('land_size');
            $table->string('task_date');
            $table->string('estimated_time')->default('pending');
            $table->string('estimated_cost')->default('pending');
            $table->string('status')->default('pending');
            $table->string('actual_cost')->nullable();
            $table->string('actual_time')->nullable();
            $table->string('rejected_by')->nullable();
            $table->string('rejected_reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    
    }
};
