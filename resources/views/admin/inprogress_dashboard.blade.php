@extends('layouts.app')


@section('dashboard')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('In Progress Booking') }}
        </h2>
    </x-slot>

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
                                <a href="{{ route('view.quotation', ['booking' => $booking]) }}" target="_blank" class="underline">View Quotation</a>
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

    
@endsection




