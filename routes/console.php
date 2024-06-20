<?php

use App\Models\BookingVehicle;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Carbon;

// Artisan::command('inspire', function () {
//     $this->comment(Inspiring::quote());
// })->purpose('Display an inspiring quote')->hourly();


Schedule::call(function () {
    $now = Carbon::now();
    // Update expired tasks
    BookingVehicle::where('status', 'cancelled')
        ->where(DB::raw("STR_TO_DATE(task_date, '%d/%m/%Y')"), '<', $now)
        ->update(['status' => 'rejected', 'rejected_by' => 'user', 'rejected_reason' => 'Tamat Tempoh Pembayaran']);
})->everyFifteenSeconds();
