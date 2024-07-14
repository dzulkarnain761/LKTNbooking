@extends('layouts.app')


@section('dashboard')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('In Progress Booking') }}
        </h2>
    </x-slot>

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
                                <a href="{{ route('view.quotation', ['booking' => $booking]) }}" target="_blank" class="hover:underline text-sm text-indigo-500">Lihat Sebut Harga</a>
                            </div>
                            

                            <div class="flex items-center gap-8">

                                <div class="flex space-x-4">
                                    <button @click="rejectBooking =!rejectBooking"
                                        class="flex items-center justify-center px-3 py-2 space-x-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-rose-500 rounded-md hover:bg-rose-600 focus:outline-none focus:bg-rose-500 focus:ring focus:ring-rose-300 focus:ring-opacity-50">
                                        <span>Selesai</span>
                                    </button>
                                    <form action="{{ route('admin.booking.edit.actual.price', ['booking' => $booking]) }}"
                                        method="GET">
                                        <button type=submit
                                            class="flex items-center justify-center px-3 py-2 space-x-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-indigo-500 rounded-md hover:bg-indigo-600 focus:outline-none focus:bg-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50">
                                            <span>Kemas Kini</span>
                                        </button>
                                    </form>
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
                            
                                <div class="space-y-4 ">
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

    
@endsection




