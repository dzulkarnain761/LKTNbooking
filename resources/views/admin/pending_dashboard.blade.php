@extends('layouts.app')

@section('dashboard')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pending Booking') }}
        </h2>
    </x-slot>



    @if (session()->has('terima'))
        <div id="session-messages-wrapper" class="max-w-7xl mx-auto sm:px-6 lg:px-8 lg:max-w-4xl">
            <div x-data="{ show: true }" x-show="show" x-transition:leave.duration.400ms=""
                class="flex bg-blue-200 text-blue-800 p-4 text-sm rounded border border-blue-300 my-3">
                <div class="flex-grow">{{ session('terima') }}</div>
                <div @click="show = false" class="flex-shrink cursor-pointer text-blue-600 hover:text-blue-800"
                    aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </div>
            </div>
        </div>
    @endif






    @if ($bookings->isNotEmpty())
        @foreach ($bookings as $booking)
            <div class="mt-8">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 lg:max-w-4xl">
                    <div class="m-2 space-y-2">
                        <div class="group flex flex-col gap-2 rounded-lg bg-white p-5 text-black shadow-md" tabindex="1">
                            <div class="flex flex-wrap cursor-pointer items-center justify-between">

                                <div class="flex flex-col">
                                    <p class="text-sm font-semibold">ID Tempahan :<span class="font-normal">
                                            {{ $booking->id }} </span></p>
                                    <p class="text-sm font-semibold">Tarikh Tempahan : <span class="font-normal">
                                            {{ $booking->created_at->format('d/m/Y') }} </span></p>
                                </div>


                                <div class="flex items-center gap-8">
                                    {{-- <span> Created at : {{ $booking->created_at->format('d/m/Y') }} </span> --}}
                                    <div x-data="{ acceptBooking: false, rejectBooking: false, }">

                                        <div class="flex space-x-4">
                                            <button @click="rejectBooking =!rejectBooking"
                                                class="flex items-center justify-center px-3 py-2 space-x-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-rose-500 rounded-md hover:bg-rose-600 focus:outline-none focus:bg-rose-500 focus:ring focus:ring-rose-300 focus:ring-opacity-50">
                                                <span>Tolak</span>
                                            </button>
                                            <form action="{{ route('admin.booking.edit', ['booking' => $booking]) }}"
                                                method="GET">
                                                <button type=submit
                                                    class="flex items-center justify-center px-3 py-2 space-x-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-indigo-500 rounded-md hover:bg-indigo-600 focus:outline-none focus:bg-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50">
                                                    <span>Terima</span>
                                                </button>
                                            </form>
                                        </div>

                                        {{-- reject modal --}}
                                        <div x-show="rejectBooking" class="fixed inset-0 z-50 overflow-y-auto"
                                            aria-labelledby="modal-title" role="dialog" aria-modal="true">
                                            <div
                                                class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">

                                                <div x-cloak @click="rejectBooking = false" x-show="rejectBooking"
                                                    x-transition:enter="transition ease-out duration-300 transform"
                                                    x-transition:enter-start="opacity-0"
                                                    x-transition:enter-end="opacity-100"
                                                    x-transition:leave="transition ease-in duration-200 transform"
                                                    x-transition:leave-start="opacity-100"
                                                    x-transition:leave-end="opacity-0"
                                                    class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-40"
                                                    aria-hidden="true">
                                                </div>

                                                <div x-cloak x-show="rejectBooking"
                                                    x-transition:enter="transition ease-out duration-300 transform"
                                                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                                    x-transition:leave="transition ease-in duration-200 transform"
                                                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                                    class="inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-2xl">
                                                    <div class="flex items-center justify-between space-x-4">
                                                        <h1 class="text-xl font-medium text-gray-800 ">Tolak Tempahan
                                                        </h1>


                                                        <button @click="rejectBooking = false"
                                                            class="text-gray-600 focus:outline-none hover:text-gray-700">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6"
                                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                    <p class="text-sm font-medium text-gray-500">Anda Pasti Untuk Tolak
                                                        Tempahan ini? Berikan Sebab :</p>

                                                    <div class="mt-5 space-y-4">

                                                        <form
                                                            action="{{ route('admin.booking.reject', ['booking' => $booking]) }}"
                                                            method="POST">
                                                            @csrf
                                                            <input type="text" name="rejected_reason" required
                                                                class="block w-full rounded-md border-0 py-1.5  pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                                                placeholder="Sebab tolak tempahan">

                                                            <div class="flex justify-end mt-6">
                                                                <button type="submit"
                                                                    class="px-3 py-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-rose-500 rounded-md hover:bg-rose-600 focus:outline-none focus:bg-rose-500 focus:ring focus:ring-rose-300 focus:ring-opacity-50">
                                                                    Tolak Tempahan
                                                                </button>
                                                        </form>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <svg class="h-10 w-4 transition-all duration-500 group-focus:-rotate-180" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 9-7 7-7-7" />
                                </svg>
                            </div>

                        </div>
                        <div
                            class="invisible h-auto max-h-0 items-center opacity-0 transition-all group-focus:visible group-focus:max-h-screen group-focus:opacity-100 group-focus:duration-1000">

                            <div class="flex flex-col space-y-4 md:flex-row md:justify-start md:gap-40 md:items-baseline">

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
            </div>
        @endforeach
    @endif

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 lg:max-w-4xl">
            {{ $bookings->links() }}
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
