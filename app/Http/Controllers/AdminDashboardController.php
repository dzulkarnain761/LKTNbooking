<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\BookingVehicle;
use App\Models\Task;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Redirect;

class AdminDashboardController extends Controller
{
    public function edit(BookingVehicle $booking)
    {   
        $vehicles = Vehicle::select('vehicle_type')->distinct()->get();
        $tasksBackhoeDB = Task::where('vehicle_type', 'Backhoe')->get();
        $tasksTracktorDB = Task::where('vehicle_type', 'Tracktor')->get();

        $tasksBackhoe = array();
        $tasksTracktor = array();

        foreach ($tasksBackhoeDB as $task) {
            $tasksBackhoe[] = array(
                'task_name' => $task->task_name,
                'task_price' => $task->price,
            );
        }

        foreach ($tasksTracktorDB as $task) {
            $tasksTracktor[] = array(

                'task_name' => $task->task_name,
                'task_price' => $task->price,
            );
        }

        $newDataCount = BookingVehicle::where('status', 'new')->count();
        return view('admin.edit', ['booking' => $booking], compact('newDataCount', 'vehicles', 'tasksBackhoe', 'tasksTracktor'));
    }

    public function update(BookingVehicle $booking, Request $request)
    {
        $id = $booking->id;
        $task = request('update_task');
        $estimated_time = request('update_estimate_time');
        $estimated_price = request('update_estimate_price');

        $allEvent = array([
            'id' => $id,
            'update_task' => $task,
            'estimate_time' => $estimated_time,
            'estimate_cost' => $estimated_price
        ]);


        // dd($allEvent);
       
        // Update booking
        $booking->update([
            'task' => $task,
            'estimated_time' => $estimated_time,
            'estimated_cost' => $estimated_price,
            'status' => 'approved'
        ]);

        // Redirect with success message
        return Redirect::route('admin.dashboard.pending')->with('terima', 'Tempahan Diterima !');
    }


    public function reject(BookingVehicle $booking, Request $request)
    {
        $rejected_reason = request('rejected_reason');
        $booking->update(['estimated_time' => 'rejected', 'estimated_cost' => 'rejected', 'status' => 'rejected', 'rejected_by'=> 'admin', 'rejected_reason' => $rejected_reason]);
        return Redirect::route('admin.dashboard.cancelled')->with('tolak', 'Tempahan Ditolak');
    }
}
