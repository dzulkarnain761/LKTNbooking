@extends('LKTNbooking/layout')

@section('title', 'LKTNbooking')


@section('header')
    @include('LKTNbooking.partials.navbar')
    <style>
        .disabled-date {
            background-color: red !important;
            pointer-events: none;
            opacity: 0.5;
        }

       
    </style>
@endsection


@section('content')

    
    <div class="mt-10 mb-10 flex flex-col max-w-5xl mx-auto">
        <div class="p-8 bg-white rounded-md shadow-md flex flex-col items-center">
            <div class="w-full md:w-2/5">
                <div id="info-container" class="flex flex-col space-y-4">
                    <div class="flex flex-col">
                        <label>Jenis Kenderaan : </label>
                        <select id="vehicle_type" class="rounded-md">
                            <option value="" disabled selected>Pilih kenderaan</option>
                            <option value="Jengkaut">Jengkaut</option>
                            <option value="Tracktor">Traktor</option>
                            <option value="Jengkaut & Traktor">Jengkaut & Traktor</option>
                        </select>
                    </div>


                    <div id="task_span" style="display:none;flex-direction:column">
                        <label>Pilihan Tugas :</label>
                        <select id="task" class="rounded-md"></select>
                    </div>

                    <x-primary-button id="add-task-button" style="display:none">Tambah Tugas</x-primary-button>

                    <!-- Added tasks section -->
                    <div id="added-tasks-container" class="mt-4 w-full" style="display: none;">
                        <h3>Tugasan yang ditambah :</h3>
                        <ul id="added-tasks-list" class="list-decimal pl-5"></ul>
                    </div>

                </div>
            </div>

        </div>
    </div>


    <div id="calendar-container" style="display:none" class="mt-10 mb-10 flex flex-col max-w-5xl mx-auto">
        <div class="p-14 bg-white rounded-md shadow-md">
            <div id='calendar'></div>
        </div>
    </div>


    <div id="main-modal" class="fixed w-full h-100 inset-0 z-50 flex justify-center items-center"
        style="background: rgba(66, 66, 66, 0.7); display:none;">
        <div class="border bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
            <div class="modal-content py-4 text-left px-6">
                <!--Title-->
                <div class="flex justify-between items-center pb-3">
                    <p class="text-2xl font-bold" id="modal-title">Header</p>
                    <div id="close-modal" class="cursor-pointer z-50">
                        <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18"
                            height="18" viewBox="0 0 18 18">
                            <path
                                d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                            </path>
                        </svg>
                    </div>
                </div>

                <!--Body-->
                <div class="my-5">
                    <p id="modal-body">Pastikan Anda Pilih Tarikh dan Tugas Yang Betul</p>
                </div>

                <!--Footer-->
                <div class="flex justify-end pt-2">
                    <form action="{{ route('confirm.booking.vehicle') }}">
                        <input type="hidden" id="selectedDate" name="selectedDate">
                        <input type="hidden" id="selectedTask" name="selectedTask">
                        <input type="hidden" id="selectedVehicle" name="selectedVehicle">
                        
                        <div class="flex space-x-4">
                            <button id="cancel-modal"
                                class="flex items-center justify-center px-3 py-2 space-x-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-gray-500 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-500 focus:ring focus:ring-gray-300 focus:ring-opacity-50">
                                <span>Tolak</span>
                            </button>

                            <button type=submit id="confirm-modal"
                                class="flex items-center justify-center px-3 py-2 space-x-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-indigo-500 rounded-md hover:bg-indigo-600 focus:outline-none focus:bg-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50">
                                <span>Terima</span>
                            </button>

                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>




    <script>
        var tasksBackhoe = @json($tasksBackhoe);
        var tasksTracktor = @json($tasksTracktor);
        var allTasks = tasksBackhoe.concat(tasksTracktor);

        var eventBackhoe = @json($eventBackhoe);
        var eventTracktor = @json($eventTracktor);
        var allEvents = eventBackhoe.concat(eventTracktor);


        // Create a new Date object for the current date and time
        const today = new Date();

        // Get the year, month, and day parts from the Date object
        const tomorrow = new Date(today);
        tomorrow.setDate(today.getDate() + 1);

        // Get the year, month, and day parts from the Date object
        const year = tomorrow.getFullYear();
        const month = String(tomorrow.getMonth() + 1).padStart(2, '0'); // Months are zero-based, so add 1 and pad with zero
        const day = String(tomorrow.getDate()).padStart(2, '0');

        // Combine the parts into a formatted string
        const formattedDate = `${year}-${month}-${day}`;


        document.addEventListener('DOMContentLoaded', () => {
            const vehicleTypeSelect = document.getElementById('vehicle_type');
            const taskSelect = document.getElementById('task');
            const taskSpan = document.getElementById('task_span');
            const calendarContainer = document.getElementById('calendar-container');
            const calendarEl = document.getElementById('calendar');
            const addTaskButton = document.getElementById('add-task-button');
            const addedTasksContainer = document.getElementById('added-tasks-container');
            const addedTasksList = document.getElementById('added-tasks-list');
            const modal = document.getElementById('main-modal');
            let date;
            let task;

            document.getElementById('close-modal').addEventListener('click', function() {
                event.preventDefault();
                modal.style.display = 'none';
            });

            document.getElementById('cancel-modal').addEventListener('click', function() {
                event.preventDefault();
                modal.style.display = 'none';
            });

            // Optional: Close the modal when clicking outside of it
            window.addEventListener('click', function(event) {
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            });


            let addedTasks = [];

            function updateTasksAndEvents(selectedVehicle) {
                taskSelect.innerHTML = ''; // Clear previous options

                let tasks = [];
                let events = [];
                let disableDate = [];

                // console.log(events.start);

                switch (selectedVehicle) {
                    case 'Jengkaut':
                        tasks = tasksBackhoe;
                        events = eventBackhoe;
                        disableDate = eventBackhoe.map(event => event.start);
                        break;
                    case 'Tracktor':
                        tasks = tasksTracktor;
                        events = eventTracktor;
                        disableDate = eventTracktor.map(event => event.start);
                        break;
                    case 'Jengkaut & Traktor':
                        tasks = allTasks;
                        events = allEvents;
                        disableDate = allEvents.map(event => event.start);
                        break;
                }


                tasks.forEach(t => {
                    const option = document.createElement('option');
                    option.value = t.task_name;
                    option.textContent = `${t.task_name} - RM ${t.task_price}`;
                    taskSelect.append(option);
                });

                taskSpan.style.display = 'flex';
                addTaskButton.style.display = 'block';
                addedTasksContainer.style.display = 'block';
                calendarContainer.style.display = 'block'; // Show calendar container


                let calendar = new Calendar(calendarEl, {
                    plugins: [dayGridPlugin, timeGridPlugin, listPlugin, interactionPlugin],
                    initialView: 'dayGridMonth',
                    aspectRatio: 2,
                    // selectable: true,
                    validRange: {
                        start: formattedDate,
                    },
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: ''
                    },
                    events: events,
                    eventBackgroundColor: 'red',
                    dateClick: function(info) {

                        // Check if the clicked date is in the disableDate array
                        if (disableDate.includes(info.dateStr)) {
                            alert('Pilih Tarikh Lain.');
                            return false; // Prevent further actions
                        }

                        if (addedTasks.length === 0) {
                            alert('Sila Tambah Tugasan!');
                        } else {
                            openModal(info.dateStr, addedTasks, vehicleTypeSelect.value);
                        }
                    },


                });

                calendar.render();


            } //updateTaskandEvent



            function addTask() {
                const selectedTask = taskSelect.value;
                if (selectedTask && !addedTasks.includes(selectedTask)) {
                    addedTasks.push(selectedTask);
                    renderAddedTasks();
                }
            }

            function removeTask(task) {
                addedTasks = addedTasks.filter(t => t !== task);
                renderAddedTasks();
            }

            function renderAddedTasks() {
                addedTasksList.innerHTML = ''; // Clear previous tasks


                if (addedTasks.length === 0) {
                    addedTasksList.innerHTML = '<p>Tugasan akan dipapar di sini.</p>';
                    // console.log(addedTasksList);
                }

                addedTasks.forEach(task => {
                    const li = document.createElement('li');
                    li.textContent = task;
                    const removeButton = document.createElement('button');
                    removeButton.textContent = 'Remove';
                    removeButton.classList.add('ml-4', 'text-red-500');
                    removeButton.onclick = () => removeTask(task);
                    li.appendChild(removeButton);
                    addedTasksList.appendChild(li);

                });
            }

            function resetTasks() {
                addedTasks = [];
                renderAddedTasks();
            }

            function formatDate(dateStr) {

                let parts = dateStr.split('-');
                return `${parts[2]}/${parts[1]}/${parts[0]}`;
            }

            function openModal(date, task, vehicle) {
                let selectedDate = formatDate(date);
                document.getElementById('selectedDate').value = selectedDate;
                document.getElementById('modal-title').innerText = selectedDate;
                document.getElementById('selectedTask').value = task;
                document.getElementById('selectedVehicle').value = vehicle;
                console.log(document.getElementById('selectedDate').value);
                console.log(document.getElementById('selectedTask').value);
                console.log(document.getElementById('selectedVehicle').value);
                modal.style.display = 'flex';
            }

            vehicleTypeSelect.addEventListener('change', (event) => {
                updateTasksAndEvents(event.target.value);
                resetTasks();
            });

            addTaskButton.addEventListener('click', addTask);
        });
    </script>

@endsection
