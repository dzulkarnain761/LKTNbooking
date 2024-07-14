@extends('layouts.app')


@section('dashboard')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update Booking') }}
        </h2>
    </x-slot>

    @if ($errors->any())
        <div id="session-messages-wrapper" class="fixed top-0 left-0 w-full flex flex-col justify-center">
            @foreach ($errors->all() as $error)
                <div class="max-w-6xl mx-auto p-2 bg-red-200 text-red-800 text-sm rounded border border-red-300 my-3">
                    {{ $error }}
                </div>
            @endforeach
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 lg:max-w-6xl">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class=" p-12 text-gray-900">

                    <div class="flex flex-col space-y-4 md:flex-row md:justify-around md:items-baseline">

                        <div class="space-y-4">
                            <div class="">
                                <p class="font-semibold text-xs ">Nama :</p>
                                <p class="">{{ $booking->user->name }}</p>
                            </div>

                            <div class="">
                                <p class="font-semibold text-xs ">Alamat :</p>
                                <p class="">{{ $booking->location }} , {{ $booking->district }},
                                    {{ $booking->state }}</p>
                            </div>


                            <div class="">
                                <p class="font-semibold text-xs ">Tugasan :</p>
                                <ol class="">
                                    @php
                                        $tugasan = explode(',', $booking->task);
                                        $counter = 1;
                                    @endphp
                                    @foreach ($tugasan as $tugas)
                                        <li>{{ $counter }}. {{ $tugas }}</li>
                                        @php $counter++; @endphp
                                    @endforeach
                                </ol>
                            </div>
                        </div>


                        <div class="space-y-4">
                            <div class="">
                                <p class="font-semibold text-xs ">Servis :</p>
                                <p class="">{{ $booking->vehicle_type }}</p>
                            </div>
                            <div class="">
                                <p class="font-semibold text-xs ">Keluasan :</p>
                                <p class="">{{ $booking->land_size }} Hektar</p>
                            </div>
                            <div class="">
                                <p class="font-semibold text-xs ">Tarikh Tugasan :</p>
                                <p class="">{{ $booking->task_date }}</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    {{-- <form action="{{ route('admin.booking.update', ['booking' => $booking]) }}" method="POST" >

        @csrf
        @method('PUT') --}}
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 lg:max-w-6xl">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class=" p-6 text-gray-900" x-data>

                <section class="container px-4 mx-auto">
                    <div class="flex flex-col">
                        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                        <thead class="bg-gray-50 dark:bg-gray-800">
                                            <tr>

                                                <th scope="col"
                                                    class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                    #
                                                </th>

                                                <th scope="col"
                                                    class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                    Tugasan
                                                </th>

                                                <th scope="col"
                                                    class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                    Anggaran Masa
                                                </th>

                                                <th scope="col"
                                                    class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                    Anggaran Harga
                                                </th>

                                                <th scope="col" class="relative py-3.5 px-4">
                                                    <span class="sr-only">Actions</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200" id="added-tasks-list">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- modal  --}}
                <div x-data="{ modelOpen: false, }" class="mt-12">
                    <button @click="modelOpen =!modelOpen"
                        class="flex items-center justify-center px-3 py-2 space-x-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-indigo-500 rounded-md dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>Tambah Tugas</span>
                    </button>

                    <div x-show="modelOpen" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title"
                        role="dialog" aria-modal="true">
                        <div
                            class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
                            <div x-cloak @click="modelOpen = false" x-show="modelOpen"
                                x-transition:enter="transition ease-out duration-300 transform"
                                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                x-transition:leave="transition ease-in duration-200 transform"
                                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-40" aria-hidden="true"></div>

                            <div x-cloak x-show="modelOpen" x-transition:enter="transition ease-out duration-300 transform"
                                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                x-transition:leave="transition ease-in duration-200 transform"
                                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                class="inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-2xl">
                                <div class="flex items-center justify-between space-x-4">
                                    <h1 class="text-xl font-medium text-gray-800 ">Tambah Tugas</h1>

                                    <button @click="modelOpen = false"
                                        class="text-gray-600 focus:outline-none hover:text-gray-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </button>
                                </div>

                                {{-- <p class="mt-2 text-sm text-gray-500 ">
                                        Add your teammate to your team and start work to get things done
                                </p> --}}

                                <form class="mt-5 space-y-4">

                                    <div>
                                        <label for="Anggaran Masa"
                                            class="block text-sm font-medium leading-6 text-gray-900">Jenis
                                            Kenderaan</label>

                                        <p> {{ $booking->vehicle_type }}</p>

                                    </div>

                                    <div>
                                        <label for="Anggaran Masa"
                                            class="block text-sm font-medium leading-6 text-gray-900">Pilih
                                            Tugas</label>

                                        <select id="task_select"
                                            class="block w-full rounded-md border-0 py-1.5  pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">

                                        </select>

                                    </div>

                                    <div class="">
                                        <label for="Anggaran Masa"
                                            class="block text-sm font-medium leading-6 text-gray-900">Anggaran Masa</label>
                                        <div class="flex space-x-4 w-1/2">

                                            <div class="relative mt-2 rounded-md shadow-sm">
                                                <input type="number" id="estimated_time_hour" value="1"
                                                    min="1"
                                                    class="block w-full rounded-md border-0 py-1.5  pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                                    placeholder="0">
                                                <div class="absolute inset-y-0 right-0 flex items-center">
                                                    <span class="text-gray-500 sm:text-sm pr-2">Jam</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="">
                                        <label for="Estimate price"
                                            class="block text-sm font-medium leading-6 text-gray-900">Estimated
                                            Price</label>

                                        {{-- <div class="relative mt-2 rounded-md shadow-sm w-1/2">

                                            <input type="text" id="estimated_price" readonly
                                                class="block w-full rounded-md border-0 py-1.5  pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                                placeholder="0">
                                            <div class="absolute inset-y-0 right-0 flex items-center">
                                                <span class="text-gray-500 sm:text-sm pr-2">MYR</span>
                                            </div>
                                        </div> --}}
                                        <p>RM : <span id="task_price"></span></p>
                                    </div>

                                    <div class="flex justify-end mt-6">
                                        <button type="button" id="add_task_button"
                                            class="px-3 py-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-indigo-500 rounded-md dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50">
                                            Tambah
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 lg:max-w-6xl">

        <form action="{{ route('admin.booking.update.estimated', ['booking' => $booking]) }}" method="POST">
            @csrf
            <input type="hidden" name="update_task" id="update_task">
            <input type="hidden" name="update_estimate_time" id="update_estimate_time">
            <input type="hidden" name="update_estimate_price" id="update_estimate_price">
            <x-primary-button type="submit" class="mt-4 w-full" id="submit_button">Terima Tempahan</x-primary-button>
        </form>
    </div>

    {{-- </form> --}}


    <script>
        var tasksBackhoe = @json($tasksBackhoe);
        var tasksTracktor = @json($tasksTracktor);
        var allTasks = tasksBackhoe.concat(tasksTracktor);

        // const vehicleTypeSelect = document.getElementById('vehicle_type');
        const taskSelect = document.getElementById('task_select');
        const addTaskButton = document.getElementById('add_task_button');
        const estimatedTimeHour = document.getElementById('estimated_time_hour');
        const estimatedPrice = document.getElementById('estimated_price');
        const addedTasksContainer = document.getElementById('added-tasks-container');
        const addedTasksList = document.getElementById('added-tasks-list');
        const taskPriceElement = document.getElementById('task_price');



        // var vehicleType = <?php echo json_encode($booking->vehicle_type); ?>;

        const vehicleType = '{{ $booking->vehicle_type }}';

        function decodeHTMLEntities(str) {
            const tempElement = document.createElement('div');
            tempElement.innerHTML = str;
            return tempElement.textContent;
        }

        const decodedVehicleType = decodeHTMLEntities(vehicleType);


        let tasks = [];
        const addedTasks = [];
        const addedPrices = [];
        const addedTimes = [];

        switch (decodedVehicleType) {
            case 'Jengkaut':
                tasks = tasksBackhoe;
                break;
            case 'Tracktor':
                tasks = tasksTracktor;
                break;
            case 'Jengkaut & Traktor':
                tasks = allTasks;
                break;
        }


        let taskPrice = 0;

        // Populate task select options
        tasks.forEach(t => {
            const option = document.createElement('option');
            option.value = `${t.task_name},${t.task_price}`;
            option.textContent = `${t.task_name} - RM ${t.task_price}`;
            taskSelect.append(option);
        });

        // Update price when a task is selected
        taskSelect.addEventListener('change', function() {
            const taskSplit = this.value.split(',');
            taskPrice = parseFloat(taskSplit[1]);
            updatePrice();
        });

        // Update price when estimated time changes
        estimatedTimeHour.addEventListener('input', function() {
            updatePrice();
        });

        function updatePrice() {
            const estimatedTime = parseFloat(estimatedTimeHour.value);
            const price = taskPrice * estimatedTime;
            taskPriceElement.innerText = price.toFixed(2);
        }

        // Initialize the price on page load
        if (taskSelect.value) {
            const taskSplit = taskSelect.value.split(',');
            taskPrice = parseFloat(taskSplit[1]);
            updatePrice();
        }

        function addTask() {
            const taskSplit = taskSelect.value.split(',');
            const taskName = taskSplit[0];
            addedTasks.push(taskName);
            addedTimes.push(`${estimatedTimeHour.value} Jam`);
            addedPrices.push(taskPrice * estimatedTimeHour.value);
            renderAddedTasks();
        }

        function renderAddedTasks() {
            const addedTasksList = document.getElementById('added-tasks-list');
            addedTasksList.innerHTML = ''; // Clear previous tasks

            addedTasks.forEach((task, index) => {
                const tr = document.createElement('tr');

                const numberTd = document.createElement('td');
                numberTd.className = 'px-4 py-4 text-sm text-gray-700 whitespace-nowrap';
                numberTd.textContent = index + 1;

                const taskTd = document.createElement('td');
                taskTd.className = 'px-4 py-4 text-sm text-gray-700 whitespace-nowrap';
                taskTd.textContent = task;

                const timeTd = document.createElement('td');
                timeTd.className = 'px-4 py-4 text-sm text-gray-700 whitespace-nowrap';
                timeTd.textContent = addedTimes[index];

                const priceTd = document.createElement('td');
                priceTd.className = 'px-4 py-4 text-sm text-gray-700 whitespace-nowrap';
                priceTd.textContent = `RM ${addedPrices[index]}`;

                const removeTd = document.createElement('td');
                removeTd.className = 'px-4 py-4 text-sm text-gray-700 whitespace-nowrap';
                const removeButton = document.createElement('button');
                removeButton.textContent = 'Remove';
                removeButton.classList.add('ml-4', 'text-red-500');
                removeButton.onclick = () => removeTask(index);
                removeTd.appendChild(removeButton);

                tr.appendChild(numberTd);
                tr.appendChild(taskTd);
                tr.appendChild(timeTd);
                tr.appendChild(priceTd);
                tr.appendChild(removeTd);

                addedTasksList.appendChild(tr);
            });
        }

        function removeTask(index) {
            addedTasks.splice(index, 1);
            addedPrices.splice(index, 1);
            addedTimes.splice(index, 1);
            renderAddedTasks();
        }

        addTaskButton.addEventListener('click', function() {
            addTask();
        });


        document.getElementById('submit_button').addEventListener('click', function() {
            event.preventDefault();
            if (addedTasks.length == 0) {
                alert('Sila Tambah Tugas');
                return false;
            }
            document.getElementById('update_task').value = addedTasks;
            document.getElementById('update_estimate_time').value = addedTimes;
            document.getElementById('update_estimate_price').value = addedPrices;
            event.target.form.submit();
        });
    </script>

@endsection
