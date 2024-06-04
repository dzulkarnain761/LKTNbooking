<?php

namespace App\Http\Controllers;

use App\Models\BookingVehicle;
use App\Models\Task;
use App\Models\Event;
use App\Models\EventBackhoe;
use App\Models\EventTracktor;
use App\Models\Vehicle;
use Illuminate\Http\Request;

use Carbon\Carbon;


class EventController extends Controller
{
    public function createEvent()
    {
    }

    public function vehicleCalendar()
    {
        // for user select
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


        // $bookingBackhoe = EventBackhoe::all();
        // $bookingTracktor = EventTracktor::all();
        // for calendar event
        $dateTracktorfromDB = BookingVehicle::where('vehicle_type', 'Tracktor')->get();
        $dateBackhoefromDB = BookingVehicle::where('vehicle_type', 'Jengkaut')->get();

        $eventBackhoe = array();
        $eventTracktor = array();

        $dateCountTracktor = [];
        $dateCountBackhoe = [];

        // Count occurrences of each date
        foreach ($dateTracktorfromDB as $booking) {

            $date = $booking->task_date;
            $date = $booking->task_date;
            $dateTime = Carbon::createFromFormat('d/m/Y', $date);
            $formattedDate = $dateTime->format('Y-m-d');

            if (!isset($dateCountTracktor[$formattedDate])) {
                $dateCountTracktor[$formattedDate] = 0;
            }
            $dateCountTracktor[$formattedDate]++;
        }

        foreach ($dateBackhoefromDB as $booking) {
            $date = $booking->task_date;
            $dateTime = Carbon::createFromFormat('d/m/Y', $date);
            $formattedDate = $dateTime->format('Y-m-d');

            if (!isset($dateCountBackhoe[$formattedDate])) {
                $dateCountBackhoe[$formattedDate] = 0;
            }
            $dateCountBackhoe[$formattedDate]++;
        }

        // Add dates that appear at least 5 times to the eventBackhoe array
        $eventBackhoe = [];
        foreach ($dateCountBackhoe as $date => $count) {
            if ($count >= 5) {
                $eventBackhoe[] = array(
                    'start' => $date, // Include the date if needed
                    'display' => 'background',
                );
            }
        }

        $eventTracktor = [];
        foreach ($dateCountTracktor as $date => $count) {
            if ($count >= 5) {
                $eventTracktor[] = array(
                    'start' => $date, // Include the date if needed
                    'display' => 'background',
                );
            }
        }


        

        // foreach ($bookingTracktor as $booking) {
        //     $date = new GlobalDateTime($booking->start);
        //     $eventTracktor[] = array(
        //         'start' => $date->format('Y-m-d'), // Format the date as 'YYYY-MM-DD'
        //         'display' => 'background',
        //     );
        // }


        if (auth()->check()) {

            return view('LKTNbooking.mycalendar', compact('vehicles', 'tasksBackhoe', 'tasksTracktor', 'eventBackhoe', 'eventTracktor'));
        } else {
            // User is not logged in, redirect to the login page
            return redirect('login');
        }


        // return view('LKTNbooking.mycalendar', compact('vehicles', 'tasksBackhoe', 'tasksTracktor', 'eventBackhoe', 'eventTracktor'));

    }
}
