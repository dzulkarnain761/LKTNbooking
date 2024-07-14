<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\BookingVehicle;
use App\Models\Task;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Auth;
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

    public function editActualPrice(BookingVehicle $booking)
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

        $id = $booking->id;
        $payment = BookingVehicle::with('payments')->findOrFail($id);
        $totalAmountPaid = $booking->payments->sum('amount');

        return view('admin.edit_actual_price', ['booking' => $booking], compact('totalAmountPaid', 'tasksBackhoe', 'tasksTracktor'));
    }

    public function update_estimated(BookingVehicle $booking, Request $request)
    {
        $id = $booking->id;
        $task = request('update_task');
        $estimated_time = request('update_estimate_time');
        $estimated_price = request('update_estimate_price');


        $user = Auth::user();

        // Update booking
        $booking->update([
            'task' => $task,
            'estimated_time' => $estimated_time,
            'estimated_cost' => $estimated_price,
            'updated_by_id' => $user->id,
            'status' => 'approved'
        ]);

        // Redirect with success message
        return Redirect::route('admin.dashboard.pending')->with('terima', 'Tempahan Diterima !');
    }

    public function update_actual(BookingVehicle $booking, Request $request)
    {

        $masa = $request->input('masa');

        // Dump the received data
        dd($masa);

        // Redirect with success message
        return Redirect::route('admin.dashboard.pending')->with('terima', 'Tempahan Diterima !');
    }


    public function reject(BookingVehicle $booking, Request $request)
    {
        $user = Auth::user();
        $rejected_reason = request('rejected_reason');
        $booking->update(['estimated_time' => '0', 'estimated_cost' => '0', 'status' => 'cancelled', 'rejected_by' => 'Admin', 'rejected_reason' => $rejected_reason, 'updated_by_id' => $user->id]);
        return Redirect::route('admin.dashboard.cancelled')->with('tolak', 'Tempahan Ditolak');
    }
}
