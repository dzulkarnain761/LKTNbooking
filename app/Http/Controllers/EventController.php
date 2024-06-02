<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Event;
use App\Models\EventBackhoe;
use App\Models\EventTracktor;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use DateTime as GlobalDateTime;

class EventController extends Controller
{
    public function myCalendar()
    {
        $vehicles = Vehicle::select('vehicle_type')->distinct()->get();
        $tasksBackhoeDB = Task::where('vehicle_type', 'Backhoe')->get();
        $tasksTracktorDB = Task::where('vehicle_type', 'Tracktor')->get();
        $bookingBackhoe = EventBackhoe::all();
        $bookingTracktor = EventTracktor::all();

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

        $eventBackhoe = array();
        $eventTracktor = array();

        foreach ($bookingBackhoe as $booking) {
            $date = new GlobalDateTime($booking->start);
            $eventBackhoe[] = array(
                'start' => $date->format('Y-m-d'), // Format the date as 'YYYY-MM-DD'
                'display' => 'background',
            );
        }

        foreach ($bookingTracktor as $booking) {
            $date = new GlobalDateTime($booking->start);
            $eventTracktor[] = array(
                'start' => $date->format('Y-m-d'), // Format the date as 'YYYY-MM-DD'
                'display' => 'background',
            );
        }

        if (auth()->check()) {

            return view('LKTNbooking.mycalendar', compact('vehicles', 'tasksBackhoe', 'tasksTracktor', 'eventBackhoe', 'eventTracktor'));
        } else {
            // User is not logged in, redirect to the login page
            return redirect('login');
        }


        // return view('LKTNbooking.mycalendar', compact('vehicles', 'tasksBackhoe', 'tasksTracktor', 'eventBackhoe', 'eventTracktor'));

    }
}
