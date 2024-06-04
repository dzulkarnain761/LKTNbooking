<?php

namespace App\Http\Controllers;

use App\Models\BookingVehicle;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\Request;

class BookingVehicleController extends Controller
{



    public function confirmBookingVehicle(Request $request)
    {
        $selectedDate = request('selectedDate');
        $selectedTask = request('selectedTask');
        $selectedVehicle = request('selectedVehicle');

        return view('LKTNbooking.confirm_booking_vehicles', compact('selectedDate', 'selectedTask', 'selectedVehicle'));
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

        // $allRequest = array(
        //     'user_id' => $userid,
        //     'selectedDate' => $selectedDate,
        //     'selectedTask' => $selectedTask,
        //     'selectedVehicle' => $selectedVehicle,
        //     'state' => $state,
        //     'district' => $district,
        //     'location' => $location,
        //     'land_size' => $land_size
        // );


        BookingVehicle::create([
            'user_id' => $userid,
            'vehicle_type' => $selectedVehicle,
            'task_date' => $selectedDate,
            'task' => $selectedTask,
            'state' => $state,
            'district' => $district,
            'location' => $location,
            'land_size' => $land_size
        ]);

        return redirect(route('dashboard.pending'));
    }
}
