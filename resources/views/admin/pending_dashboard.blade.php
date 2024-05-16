@extends('layouts.app')

@section('dashboard')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pending Booking') }}
        </h2>
    </x-slot>



    @if (session()->has('terima') || session()->has('tolak'))
        <div id="session-messages-wrapper" class="fixed top-0 left-0 w-full flex justify-center">
            @if (session()->has('terima'))
                <div class="max-w-6xl mx-auto p-2 bg-blue-200 text-blue-800 text-sm rounded border border-blue-300 my-3">
                    {{ session('terima') }}
                </div>
            @elseif(session()->has('tolak'))
                <div
                    class="max-w-6xl mx-auto p-2 bg-yellow-100 text-yellow-800 text-sm rounded border border-yellow-300 my-3">
                    {{ session('tolak') }}
                </div>
            @endif
        </div>
    @endif



    {{-- @if ($bookings->isNotEmpty())
        @foreach ($bookings as $booking)
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 lg:max-w-4xl">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="flex flex-col p-6 items-center">
                            <div class="flex flex-col w-3/4 gap-4 lg:w-1/2 items-center">
                                <p class="font-bold uppercase ">Booking ID : #{{ $booking->id }}</p>
                                <div class="flex gap-12">

                                    <div class="flex gap-16">
                                        <div>

                                            <p class="font-bold uppercase">Created at</p>
                                            <p class="font-bold uppercase">Full Name</p>
                                            <p class="font-bold uppercase">Servis</p>
                                            <p class="font-bold uppercase">tarikh</p>
                                            <p class="font-bold uppercase">alamat</p>
                                            <p class="font-bold uppercase">daerah</p>
                                            <p class="font-bold uppercase">negeri</p>
                                            <p class="font-bold uppercase">Keluasan</p>
                                            <p class="font-bold uppercase">Tugas</p>
                                        </div>

                                        <div>
                                            <p class="font-bold uppercase">: </p>
                                            <p class="font-bold uppercase">: </p>
                                            <p class="font-bold uppercase">: </p>
                                            <p class="font-bold uppercase">: </p>
                                            <p class="font-bold uppercase">: </p>
                                            <p class="font-bold uppercase">: </p>
                                            <p class="font-bold uppercase">: </p>
                                            <p class="font-bold uppercase">: </p>
                                            <p class="font-bold uppercase">: </p>
                                        </div>
                                    </div>
                                    @php
                                        $tugasan = explode(',', $booking->tugas);
                                        $bookingDateCreated = $booking->created_at;
                                        $dateOnly = date('d/m/Y', strtotime($bookingDateCreated));

                                        
                                    @endphp

                                    <div class="flex flex-col items-end ">

                                        <p class="uppercase">{{ $dateOnly }}</p>
                                        <p class="uppercase">{{ $booking->user->name }}</p>
                                        <p class="uppercase">{{ $booking->servistype }} </p>
                                        <p class="uppercase">{{ $booking->task_date }} </p>
                                        <p class="uppercase">{{ $booking->kawasan }}</p>
                                        <p class="uppercase">{{ $booking->daerah }}</p>
                                        <p class="uppercase">{{ $booking->negeri }}</p>
                                        <p class="uppercase">{{ $booking->keluasan }} Hektar</p>

                                        <ol>
                                            @php $counter = 1; @endphp
                                            @foreach ($tugasan as $tugas)
                                                <li>{{ $counter }}. {{ $tugas }}</li>
                                                @php $counter++; @endphp
                                            @endforeach
                                        </ol>

                                    </div>

                                </div>
                                <div x-data="{ reject: false }">
                                    <!-- Modal for rejecting booking -->
                                    <div x-show="reject"
                                        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                                        <div class="bg-white rounded-lg p-8">
                                            <h1 class="text-xl mb-4 font-bold text-gray-700">Tolak Tempahan?</h1>
                                            <div class="flex justify-center">
                                                <button class="bg-gray-500 text-white px-4 py-2 rounded-md mr-4"
                                                    @click="reject = false">Cancel</button>
                                                <a href="{{ route('admin.booking.reject', ['booking' => $booking]) }}"
                                                    class="bg-red-500 text-white px-4 py-2 rounded-md">Tolak</a>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Buttons for accepting or rejecting booking -->
                                    <div class="flex gap-4">
                                        <button @click="reject = true"
                                            class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md">Tidak
                                            Terima</button>
                                        <a href="{{ route('admin.booking.edit', ['booking' => $booking]) }}"
                                            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">Terima</a>
                                    </div>
                                </div>


                            </div>

                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif --}}


    @if ($bookings->isNotEmpty())
        @foreach ($bookings as $booking)
            <div class="py-8">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 lg:max-w-4xl">
                    <div class="m-2 space-y-2">
                        <div class="group flex flex-col gap-2 rounded-lg bg-white p-5 text-black shadow-md" tabindex="1">
                            <div class="flex flex-wrap cursor-pointer items-center justify-between">

                                <div class="flex flex-col">
                                <span> Booking ID : {{ $booking->id }} </span>
                                <span> Created at : {{ $booking->created_at->format('d/m/Y') }} </span>
                                </div>
                                

                                <div class="flex items-center gap-8">
                                    {{-- <span> Created at : {{ $booking->created_at->format('d/m/Y') }} </span> --}}
                                    <div x-data="{ reject: false }">
                                        <!-- Modal for rejecting booking -->
                                        <div x-cloak x-show="reject"
                                            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                                            <div class="bg-white rounded-lg p-8">
                                                <h1 class="text-xl mb-4 font-bold text-gray-700">Tolak Tempahan?</h1>
                                                <div class="flex justify-center">
                                                    <button class="bg-gray-500 text-white px-4 py-2 rounded-md mr-4"
                                                        @click="reject = false">Cancel</button>
                                                    <a href="{{ route('admin.booking.reject', ['booking' => $booking]) }}"
                                                        class="bg-red-500 text-white px-4 py-2 rounded-md">Tolak</a>
                                                </div>
                                            </div>
                                        </div>
    
                                        <!-- Buttons for accepting or rejecting booking -->
                                        <div class="flex gap-4">
                                            <button @click="reject = true"
                                                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md">Tidak
                                                Terima</button>
                                            <a href="{{ route('admin.booking.edit', ['booking' => $booking]) }}"
                                                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">Terima</a>
                                        </div>
                                    </div>
                                    <svg class="h-10 w-4 transition-all duration-500 group-focus:-rotate-180"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m19 9-7 7-7-7" />
                                    </svg>
                                </div>

                            </div>
                            <div
                                class="invisible h-auto max-h-0 items-center opacity-0 transition-all group-focus:visible group-focus:max-h-screen group-focus:opacity-100 group-focus:duration-1000">
                                <div class="flex justify-between">

                                    <div class="flex gap-16">
                                        <div>

                                            
                                            <p class="font-bold uppercase">Full Name</p>
                                            <p class="font-bold uppercase">Servis</p>
                                            <p class="font-bold uppercase">tarikh</p>
                                            <p class="font-bold uppercase">alamat</p>
                                            <p class="font-bold uppercase">daerah</p>
                                            <p class="font-bold uppercase">negeri</p>
                                            <p class="font-bold uppercase">Keluasan</p>
                                            <p class="font-bold uppercase">Tugas</p>
                                        </div>

                                        <div>
                                            
                                            <p class="font-bold uppercase">: </p>
                                            <p class="font-bold uppercase">: </p>
                                            <p class="font-bold uppercase">: </p>
                                            <p class="font-bold uppercase">: </p>
                                            <p class="font-bold uppercase">: </p>
                                            <p class="font-bold uppercase">: </p>
                                            <p class="font-bold uppercase">: </p>
                                            <p class="font-bold uppercase">: </p>
                                        </div>
                                    </div>
                                    @php
                                        $tugasan = explode(',', $booking->tugas);
                                        $bookingDateCreated = $booking->created_at;
                                        $dateOnly = date('d/m/Y', strtotime($bookingDateCreated));

                                    @endphp

                                    <div class="flex flex-col items-end ">

                                        
                                        <p class="uppercase">{{ $booking->user->name }}</p>
                                        <p class="uppercase">{{ $booking->servistype }} </p>
                                        <p class="uppercase">{{ $booking->task_date }} </p>
                                        <p class="uppercase">{{ $booking->kawasan }}</p>
                                        <p class="uppercase">{{ $booking->daerah }}</p>
                                        <p class="uppercase">{{ $booking->negeri }}</p>
                                        <p class="uppercase">{{ $booking->keluasan }} Hektar</p>

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
        @endforeach
    @endif



    <script>
        setTimeout(function() {
            var element = document.getElementById("session-messages-wrapper");
            if (element)
                element.remove();
        }, 5000); // Remove after 3 seconds (3000 milliseconds)
    </script>

@endsection
