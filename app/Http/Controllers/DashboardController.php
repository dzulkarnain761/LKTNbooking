<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookingVehicle;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function adminPending()
    {
        $booking = BookingVehicle::where('status', 'pending')->paginate(5);
        return view('admin.pending_dashboard', ['bookings' => $booking]);
    }

    public function adminApproved()
    {
        $booking = BookingVehicle::where('status', 'approved')->paginate(5);
        return view('admin.approved_dashboard', ['bookings' => $booking]);
    }

    public function adminInProgress()
    {
        $booking = BookingVehicle::where('status', 'inprogress')->paginate(5);
        return view('admin.inprogress_dashboard', ['bookings' => $booking]);
    }

    public function adminCompleted()
    {
        $booking = BookingVehicle::where('status', 'completed')->paginate(5);
        return view('admin.completed_dashboard', ['bookings' => $booking]);
    }

    public function adminCancelled()
    {
        $bookings = BookingVehicle::where('status', 'rejected')
            ->orderBy('updated_at', 'desc')
            ->paginate(5);
        
        return view('admin.cancelled_dashboard', ['bookings' => $bookings]);
    }



    // user part
    public function userPending()
    {

        $user = Auth::user();

        $booking = BookingVehicle::where('user_id', $user->id)->where('status', 'pending')->paginate(5);
        
        return view('user.pending_dashboard', ['bookings' => $booking]);
    }

    public function userApproved()
    {

        $user = Auth::user();

        $booking = BookingVehicle::where('user_id', $user->id)->where('status', 'approved')->paginate(5);
        
        return view('user.approved_dashboard', ['bookings' => $booking]);
    }

    public function userInProgress()
    {

        $user = Auth::user();

        $booking = BookingVehicle::where('user_id', $user->id)->where('status', 'inprogress')->paginate(5);
        
        return view('user.inprogress_dashboard', ['bookings' => $booking]);
    }

    public function userCompleted()
    {

        $user = Auth::user();
        $booking = BookingVehicle::where('user_id', $user->id)->where('status', 'completed')->paginate(5);
        return view('user.completed_dashboard', ['bookings' => $booking]);
    }

    public function userCancelled()
    {
        $user = Auth::user();
        $booking = BookingVehicle::where('user_id', $user->id)->where('status', 'rejected')->paginate(5);
        return view('user.cancelled_dashboard', ['bookings' => $booking]);
    }
}
