<?php

namespace App\Http\Controllers;

use App\Models\BookingVehicle;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UserDashboardController extends Controller
{
    public function reject(BookingVehicle $booking, Request $request){
        
        $rejected_reason = request('rejected_reason');
        $booking->update(['estimated_time' => 'rejected', 'estimated_cost' => 'rejected', 'status' => 'rejected', 'rejected_by' => 'User', 'rejected_reason' => $rejected_reason]);
        return Redirect::route('dashboard.cancelled')->with('tolak', 'Tempahan Ditolak');
    }

    public function select_payment(BookingVehicle $booking)
    {
        return view('user.select_payment', ['booking' => $booking]);
    }

    public function payment_succeed(BookingVehicle $booking, Request $request){
        
        $paymentAmount = request('totalPayment');

        $payment = Payment::create([
            'booking_vehicle_id' => $booking->id,
            'amount' => $paymentAmount,
            'status' => 'completed',
            'payment_date' => now()
        ]);

        $booking->update(['status' => 'inprogress']);
        return Redirect::route('dashboard.inprogress')->with('payment_succeed', 'Bayaran Berjaya Dibuat');
    }
}
