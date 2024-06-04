@extends('layouts.app')

@section('dashboard')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Completed Booking') }}
        </h2>
    </x-slot>


    @if ($bookings->isNotEmpty())
        @foreach ($bookings as $booking)
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="flex flex-col p-6 items-center">
                            <div class="flex flex-col w-3/4 gap-4 lg:w-1/2 items-center">
                                <p class="font-bold uppercase ">Booking ID : #{{ $booking->id }}</p>
                                <div class="flex gap-12">

                                    <div class="flex gap-16">
                                        <div>
                                            <p class="font-bold uppercase">Created at</p>
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
                                        $tugasan = explode(',', $booking->task);
                                        $bookingDateCreated = $booking->created_at;
                                        $dateOnly = date('d/m/Y', strtotime($bookingDateCreated));

                                    @endphp

                                    <div class="flex flex-col items-end ">
                                        <p class="uppercase">{{ $dateOnly }}</p>
                                        <p class="uppercase">{{ $booking->vehicle_type }} </p>
                                        <p class="uppercase">{{ $booking->task_date }} </p>
                                        <p class="uppercase">{{ $booking->location }}</p>
                                        <p class="uppercase">{{ $booking->district }}</p>
                                        <p class="uppercase">{{ $booking->state }}</p>
                                        <p class="uppercase">{{ $booking->land_size }} Hektar</p>

                                        <ol>
                                            @php $counter = 1; @endphp
                                            @foreach ($tugasan as $tugas)
                                                <li>{{ $counter }}. {{ $tugas }}</li>
                                                @php $counter++; @endphp
                                            @endforeach
                                        </ol>

                                    </div>

                                </div>

                                @if ($booking->status == 'accepted')
                                    <div class="flex  gap-4">
                                        <button
                                            class="p-2 px-4 rounded bg-blue-500 hover:bg-blue-600 text-white border-blue-700 mx-1">Bayar</button>
                                        <button type="submit"
                                            class="p-2 px-4 rounded bg-red-500 hover:bg-red-600 text-white border-red-700 mx-1">Cancel</button>
                                    </div>
                                @endif

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        @endforeach
    @endif

@endsection



