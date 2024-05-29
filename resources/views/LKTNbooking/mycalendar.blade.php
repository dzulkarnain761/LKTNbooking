@extends('LKTNbooking/layout')

@section('title', 'LKTNbooking')


@section('header')
    @include('LKTNbooking.partials.navbar')

@endsection


@section('content')


    <div class="mt-10 mb-10 flex flex-col max-w-5xl mx-auto">
        <div class="p-8 bg-white rounded-md shadow-md flex flex-col items-center">
            <div id="info-container" class="flex flex-col space-y-4">
                <div>
                    <label>Jenis Kenderaan : </label>
                    <select id="vehicle_type" class="rounded-md">
                        <option value="" disabled selected>Pilih kenderaan</option>
                        <option value="Backhoe">Backhoe</option>
                        <option value="Tracktor">Tracktor</option>
                        <option value="Jengkaut & Traktor">Jengkaut & Traktor</option>
                    </select>
                </div>


                <div id="task_span" style="display:none;flex-direction:column">
                    <label>Tugas :</label>
                    <select id="task" class="rounded-md"></select>
                    {{-- <select id="task2" class="rounded-md"></select> --}}
                </div>

                <x-primary-button id="add-task-button" style="display:none">Tambah Tugas</x-primary-button>


            </div>
        </div>
    </div>


    <div id="calendar-container" style="display:none" class="mt-10 mb-10 flex flex-col max-w-5xl mx-auto">
        <div class="p-14 bg-white rounded-md shadow-md">
            <div id='calendar'></div>
        </div>
    </div>




    <script>
        var tasksBackhoe = @json($tasksBackhoe);
        var tasksTracktor = @json($tasksTracktor);
        var allTasks = tasksBackhoe.concat(tasksTracktor);

        var eventBackhoe = @json($eventBackhoe);
        var eventTracktor = @json($eventTracktor);
        var allEvents = eventBackhoe.concat(eventTracktor);

        document.addEventListener('DOMContentLoaded', () => {
            const vehicleTypeSelect = document.getElementById('vehicle_type');
            const taskSelect = document.getElementById('task');
            const taskSpan = document.getElementById('task_span');
            const calendarContainer = document.getElementById('calendar-container');
            const calendarEl = document.getElementById('calendar');
            const addTask = document.getElementById('add-task-button');

            let calendar;

            function updateTasksAndEvents(selectedVehicle) {
                taskSelect.innerHTML = ''; // Clear previous options

                let tasks = [];
                let events = [];

                switch (selectedVehicle) {
                    case 'Backhoe':
                        tasks = tasksBackhoe;
                        events = eventBackhoe;
                        break;
                    case 'Tracktor':
                        tasks = tasksTracktor;
                        events = eventTracktor;
                        break;
                    case 'Jengkaut & Traktor':
                        tasks = allTasks;
                        events = allEvents;
                        break;
                }

                tasks.forEach(t => {
                    const option = document.createElement('option');
                    option.value = t.task_name;
                    option.textContent = `${t.task_name} - RM ${t.task_price}`;
                    taskSelect.append(option);
                });

                taskSpan.style.display = 'flex';
                addTask.style.display = 'block';
                calendarContainer.style.display = 'block'; // Show calendar container

                setTimeout(() => {
                    if (!calendar) {
                        calendar = new Calendar(calendarEl, {
                            plugins: [dayGridPlugin, timeGridPlugin, listPlugin, interactionPlugin],
                            initialView: 'dayGridMonth',
                            aspectRatio: 2,
                            selectable: true,
                            headerToolbar: {
                                left: 'prev,next today',
                                center: 'title',
                                right: ''
                            },
                            events: allEvents,
                            eventBackgroundColor: 'red',
                            dateClick: function(info) {
                                alert('hello');
                            }
                        });

                        calendar.render();
                    } else {
                        // Update the events dynamically
                        calendar.removeAllEvents(); // Clear current events
                        events.forEach(event => {
                            calendar.addEvent(event); // Add new events
                        });
                    }
                }, 0); // Delay rendering the calendar to ensure the container is visible and ready
            }

            vehicleTypeSelect.addEventListener('change', (event) => {
                updateTasksAndEvents(event.target.value);

            });
        });
    </script>





@endsection
