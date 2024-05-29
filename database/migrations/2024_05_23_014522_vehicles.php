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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('vehicle_type');
            $table->string('plate_number');
        });

        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('task_name');
            $table->string('vehicle_type');
            $table->string('price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
