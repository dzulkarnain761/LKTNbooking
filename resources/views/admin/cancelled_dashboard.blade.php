@extends('layouts.app')

@section('dashboard')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cancelled/Rejected Booking') }}
        </h2>
    </x-slot>



    @if (session()->has('tolak'))
    
        <div id="session-messages-wrapper" class="max-w-7xl mx-auto sm:px-6 lg:px-8 lg:max-w-4xl">
            <div x-data="{ show: true }" x-show="show" x-transition:leave.duration.400ms=""
                class="flex bg-rose-200 text-rose-800 p-4 text-sm rounded border border-rose-300 my-3">
                <div class="flex-grow">{{ session('tolak') }}</div>
                <div @click="show = false" class="flex-shrink cursor-pointer text-rose-600 hover:text-rose-800"
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
                                    <p class="text-sm font-semibold">ID Tempahan :<span class="font-normal">  {{ $booking->id }} </span></p>
                                    <p class="text-sm font-semibold">Tarikh Tempahan : <span class="font-normal">  {{ $booking->created_at->format('d/m/Y') }} </span></p>
                                </div>


                                <div class="flex items-center gap-8">
                                    {{-- <a href="{{ route('view.quotation', ['booking' => $booking]) }}" target="_blank"
                                        class="underline">View Quotation</a> --}}
                                        <p class="text-sm font-semibold">Ditolak Oleh : <span class="font-normal">{{$booking->rejected_by}}</span></p>
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

                                        <div class="">
                                            <p class="font-semibold text-xs ">Sebab ditolak :</p>
                                            <p class="">{{ $booking->rejected_reason }}</p>
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
        }, 3000); // Remove after 3 seconds (3000 milliseconds)
    </script>
@endsection
