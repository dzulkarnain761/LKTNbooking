<?php

namespace App\Http\Controllers;

use App\Models\BookingVehicle;
use App\Models\TaskLocation;
use App\Models\User;
use App\Notifications\BookingNotification;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingVehicleController extends Controller
{

    public function confirmBookingVehicle(Request $request)
    {
        $selectedDate = request('selectedDate');
        $selectedTask = request('selectedTask');
        $selectedVehicle = request('selectedVehicle');

        $states = TaskLocation::distinct()->pluck('state')->toArray();
        $getTaskLocation = TaskLocation::all();

        $district = array();
        foreach ($getTaskLocation as $tasklocation) {
            $district[] = array(
                'district' => $tasklocation->district,
                'state' => $tasklocation->state,
            );
        }

        return view('LKTNbooking.confirm_booking_vehicles', compact('selectedDate', 'selectedTask', 'selectedVehicle', 'states', 'district'));
    }


    public function store(Request $request)
    {
        $userid = request('userid');
        $selectedDate = request('selectedDate');
        $selectedTask = request('selectedTask');
        $selectedVehicle = request('selectedVehicle');
        $state = request('state');
        $district = request('district');
        $location = request('location');
        $land_size = request('land_size');

        $bookingVehicle = BookingVehicle::create([
            'user_id' => $userid,
            'vehicle_type' => $selectedVehicle,
            'task_date' => $selectedDate,
            'task' => $selectedTask,
            'state' => $state,
            'district' => $district,
            'location' => $location,
            'land_size' => $land_size
        ]);

        // // Fetch admin user
        // $user = $request->user();

        // // Send notification to admin
        // $user->notify(new BookingNotification($bookingVehicle));

        return Redirect::route('dashboard.pending')->with('success-create-order', 'Tempahan Berjaya Dibuat!')->with('bookingVehicle', $bookingVehicle);;
    }
}
