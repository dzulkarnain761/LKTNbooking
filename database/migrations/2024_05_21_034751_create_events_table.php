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
        Schema::create('event_tracktor', function (Blueprint $table) {
            $table->id();
            $table->dateTime('start');
            $table->dateTime('end');
            $table->timestamps();
        });

        Schema::create('event_backhoe', function (Blueprint $table) {
            $table->id();
            $table->dateTime('start');
            $table->dateTime('end');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events_jengkaut');
        Schema::dropIfExists('events_traktor');
    }
};
