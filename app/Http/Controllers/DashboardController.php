<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookingVehicle;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function adminPending()
    {
        $booking = BookingVehicle::where('status', 'pending')->get();
        $newDataCount = BookingVehicle::where('status', 'approved')->count();
        return view('admin.pending_dashboard', ['bookings' => $booking, 'newDataCount' => $newDataCount]);
    }

    public function adminInProgress()
    {
        $booking = BookingVehicle::where('status', 'approved')->orWhere('status', 'confirmed')->get();
        $newDataCount = BookingVehicle::where('status', 'approved')->count();
        return view('admin.inprogress_dashboard', ['bookings' => $booking, 'newDataCount' => $newDataCount]);
    }

    public function adminCompleted()
    {
        $booking = BookingVehicle::where('status', 'completed')->get();
        $newDataCount = BookingVehicle::where('status', 'approved')->count();
        return view('admin.completed_dashboard', ['bookings' => $booking, 'newDataCount' => $newDataCount]);
    }

    public function adminCancelled()
    {
        $bookings = BookingVehicle::where('status', 'rejected')
            ->orderBy('updated_at', 'desc')
            ->paginate(5);
        $newDataCount = BookingVehicle::where('status', 'approved')->count();
        return view('admin.cancelled_dashboard', ['bookings' => $bookings, 'newDataCount' => $newDataCount]);
    }



    // user part
    public function userPending()
    {

        $user = Auth::user();

        $booking = BookingVehicle::where('user_id', $user->id)->where('status', 'pending')->get();
        $newDataCount = BookingVehicle::where('status', 'approved')->count();
        return view('user.pending_dashboard', ['bookings' => $booking, 'newDataCount' => $newDataCount]);
    }

    public function userApproved()
    {

        $user = Auth::user();

        $booking = BookingVehicle::where('user_id', $user->id)->where('status', 'approved')->get();
        $newDataCount = BookingVehicle::where('status', 'approved')->count();
        return view('user.approved_dashboard', ['bookings' => $booking, 'newDataCount' => $newDataCount]);
    }

    public function userCompleted()
    {

        $user = Auth::user();

        $booking = BookingVehicle::where('user_id', $user->id)->where('status', 'completed')->get();
        $newDataCount = BookingVehicle::where('status', 'approved')->count();
        return view('user.completed_dashboard', ['bookings' => $booking, 'newDataCount' => $newDataCount]);
    }

    public function userCancelled()
    {

        $user = Auth::user();

        $booking = BookingVehicle::where('user_id', $user->id)->where('status', 'rejected')->get();
        $newDataCount = BookingVehicle::where('status', 'approved')->count();
        return view('user.cancelled_dashboard', ['bookings' => $booking, 'newDataCount' => $newDataCount]);
    }
}
