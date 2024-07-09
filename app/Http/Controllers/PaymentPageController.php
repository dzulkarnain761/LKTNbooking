<?php

namespace App\Http\Controllers;
use App\Models\BookingVehicle;
use Illuminate\Http\Request;

class PaymentPageController extends Controller
{
    public function payment(BookingVehicle $booking)
    {
        return view('payment_page', ['booking' => $booking]);
    }
}
