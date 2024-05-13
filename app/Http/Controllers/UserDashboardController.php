<?php

namespace App\Http\Controllers;

use App\Models\BookingVehicle;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function reject(BookingVehicle $booking, Request $request){

        $booking->update(['estimated_time' => 'rejected', 'estimated_cost' => 'rejected', 'status' => 'rejected']);

        return redirect(route('dashboard.cancelled'))->with('tolak', 'Tempahan Ditolak');
    }
}
