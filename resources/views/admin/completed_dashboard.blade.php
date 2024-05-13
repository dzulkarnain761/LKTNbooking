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
                                
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

    
@endsection




