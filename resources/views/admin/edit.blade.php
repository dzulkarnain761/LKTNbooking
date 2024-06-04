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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 lg:max-w-4xl">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class=" p-6 text-gray-900">

                    <div class="flex flex-row justify-between items-center" x-data="{
                        open: false,
                    }">
                        <div>
                            <p class="font-bold uppercase">Tempahan ID : <span class="font-normal">
                                    {{ $booking->id }}</span></p>

                            <p class="font-bold uppercase">Nama : <span class="font-normal">{{ $booking->user->name }}
                                </span></p>
                                <p class="font-bold uppercase">Phone Number : <span class="font-normal">{{ $booking->user->phone_number }}
                                </span></p>
                            <p class="font-bold uppercase">Servis : <span class="font-normal">
                                    {{ $booking->vehicle_type }}</span></p>
                            <p class="font-bold uppercase">Alamat : <span class="font-normal"> {{ $booking->location }},
                                    {{ $booking->district }}, {{ $booking->state }}</span>
                            </p>
                            <p class="font-bold uppercase">Keluasan : <span class="font-normal">{{ $booking->land_size }}
                                    Hektar </span> </p>
                            <p class="font-bold uppercase">Tarikh : <span class="font-normal"> {{ $booking->task_date }}
                                </span></p>

                            @php
                                $tugasan = explode(',', $booking->task);
                            @endphp
                            <p class="font-bold uppercase">Tugasan : </p>
                            <ol>
                                @php $counter = 1; @endphp
                                @foreach ($tugasan as $tugas)
                                    <li>{{ $counter }}. {{ $tugas }}</li>
                                    @php $counter++; @endphp
                                @endforeach
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 lg:max-w-4xl">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class=" p-6 text-gray-900">

                    <form action="{{ route('admin.booking.update', ['booking' => $booking]) }}" method="POST"
                        class="flex flex-col gap-2">

                        @csrf
                        @method('PUT')
                        
                        <div>
                            <label for="Anggaran Masa" class="block text-sm font-medium leading-6 text-gray-900">Anggaran Masa</label>
                            <div class="relative mt-2 rounded-md shadow-sm">
                                
                                <input type="text" name="estimated_time_day" class="block w-full rounded-md border-0 py-1.5  pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="0">
                                <div class="absolute inset-y-0 right-0 flex items-center">
                                    <span class="text-gray-500 sm:text-sm pr-2">Hari</span>
                                </div>
                                
                            </div>

                            <div class="relative mt-2 rounded-md shadow-sm">
                                
                                <input type="text" name="estimated_time_hour" class="block w-full rounded-md border-0 py-1.5  pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="0">
                                <div class="absolute inset-y-0 right-0 flex items-center">
                                    <span class="text-gray-500 sm:text-sm pr-2">Jam</span>
                                </div>
                                
                            </div>
                        </div>

                        <div>
                            <label for="Anggaran Harga" class="block text-sm font-medium leading-6 text-gray-900">Anggaran Harga</label>
                            <div class="relative mt-2 rounded-md shadow-sm">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <span class="text-gray-500 sm:text-sm">RM</span>
                                </div>
                                <input type="text" name="estimated_cost" id="estimated_cost" class="block w-full rounded-md border-0 py-1.5 pl-10 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="0.00">
                                <div class="absolute inset-y-0 right-0 flex items-center">
                                    <span class="text-gray-500 sm:text-sm pr-2">MYR</span>
                                </div>
                            </div>
                        </div>
                        

                        <x-primary-button type="submit" class="mt-4">terima tempahan</x-primary-button>
                    </form>


                </div>
            </div>
        </div>
    

        

    <script>
        setTimeout(function() {
            var element = document.getElementById("session-messages-wrapper");
            if (element)
                element.remove();
        }, 5000); // Remove after 3 seconds (3000 milliseconds)
    </script>

@endsection
