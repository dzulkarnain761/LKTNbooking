<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('booking_vehicles', function (Blueprint $table) {
            
        });
  
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('booking_vehicles', function($table) {
        //     $table->dropColumn('reject_by');
        //     $table->dropColumn('reject_reason');
        // });
    }
};
