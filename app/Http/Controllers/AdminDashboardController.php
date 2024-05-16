<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookingVehicle;


class AdminDashboardController extends Controller
{
    public function edit(BookingVehicle $booking)
    {
        $newDataCount = BookingVehicle::where('status', 'new')->count();
        return view('admin.edit', ['booking' => $booking], compact('newDataCount'));
    }

    public function update(BookingVehicle $booking, Request $request)
    {
        // Validate input data
        $request->validate([
            'estimated_time_day' => ['required'],
            'estimated_time_hour' => ['required'],
            'estimated_cost' => ['required', 'decimal:0,2'] // Assuming estimated cost is a number
        ]);

        // Sanitize input
        $estimated_time_day = $request->input('estimated_time_day');
        $estimated_time_hour = $request->input('estimated_time_hour');
        $estimated_cost = $request->input('estimated_cost');

        $estimated_time = $estimated_time_day . " Hari " .  $estimated_time_hour . " Jam";


        // Update booking
        $booking->update([
            'estimated_time' => $estimated_time,
            'estimated_cost' => $estimated_cost,
            'status' => 'approved'
        ]);

        // Redirect with success message
        return redirect(route('admin.dashboard.pending'))->with('terima', 'Booking updated successfully!');
    }


    public function reject(BookingVehicle $booking, Request $request)
    {
        $booking->update(['estimated_time' => 'rejected', 'estimated_cost' => 'rejected', 'status' => 'rejected']);

        return redirect(route('admin.dashboard.cancelled'))->with('tolak', 'Tempahan Ditolak');
    }
}
