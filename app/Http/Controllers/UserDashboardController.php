<?php

namespace App\Http\Controllers;

use App\Models\BookingVehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UserDashboardController extends Controller
{
    public function reject(BookingVehicle $booking, Request $request){
        
        $rejected_reason = request('rejected_reason');
        $booking->update(['estimated_time' => 'rejected', 'estimated_cost' => 'rejected', 'status' => 'rejected', 'rejected_by' => 'User', 'rejected_reason' => $rejected_reason]);
        return Redirect::route('dashboard.cancelled')->with('tolak', 'Tempahan Ditolak');
    }
}
