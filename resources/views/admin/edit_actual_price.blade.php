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

                    <div class="flex flex-col space-y-4 md:flex-row md:justify-between md:items-baseline md:px-8">


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
                                <p class="font-semibold text-xs ">Tarikh Tugasan :</p>
                                <p class="">{{ $booking->task_date }}</p>
                            </div>

                        </div>
                        <div class="space-y-4 sm:pr-32 xl:pr-60">
                            <div class="">
                                <p class="font-semibold text-xs ">Servis :</p>
                                <p class="">{{ $booking->vehicle_type }}</p>
                            </div>
                            <div class="">
                                <p class="font-semibold text-xs ">Keluasan :</p>
                                <p class="">{{ $booking->land_size }} Hektar</p>
                            </div>
                            <div class="">
                                <p class="font-semibold text-xs ">Pembayaran :</p>
                                <p class=""> RM {{ $totalAmountPaid }} </p>
                            </div>

                        </div>

                    </div>


                    @php
                        $tugasan = explode(',', $booking->task);
                        $masa = explode(',', $booking->estimated_time);
                        $harga = explode(',', $booking->estimated_cost);
                        $counter = 1;
                    @endphp

                    <section class="container px-4 mx-auto mt-10">
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

                                                    
                                                </tr>
                                            </thead>
                                            @foreach ($tugasan as $index => $tugas)
                                                <tbody class="bg-white divide-y divide-gray-200" id="added-tasks-list">
                                                    <td class="px-4 py-4 text-sm text-gray-700 whitespace-nowrap">
                                                        {{ $counter }}</td>

                                                    <td class="px-4 py-4 text-sm text-gray-700 whitespace-nowrap">
                                                        {{ $tugas }}</td>
                                                    <td class="px-4 py-4 text-sm text-gray-700 whitespace-nowrap">
                                                        {{ $masa[$index] }}</td>
                                                    <td class="px-4 py-4 text-sm text-gray-700 whitespace-nowrap">RM
                                                        {{ $harga[$index] }}</td>
                                                </tbody>

                                                @php $counter++ @endphp
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

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

                <section class="container px-4 mx-auto mt-10">
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
                                                    Masa Sebenar
                                                </th>

                                                <th scope="col"
                                                    class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                    Harga Sebenar
                                                </th>

                                                
                                            </tr>
                                        </thead>
                                        <form action="{{ route('admin.booking.update.actual', ['booking' => $booking]) }}"
                                            method="POST">
                                            @foreach ($tugasan as $index => $tugas)
                                            <tbody class="bg-white divide-y divide-gray-200" id="added-tasks-list">
                                                <tr>
                                                    <td class="px-4 py-4 text-sm text-gray-700 whitespace-nowrap">
                                                        {{ $counter }}
                                                    </td>
                                                    <td class="px-4 py-4 text-sm text-gray-700 whitespace-nowrap">
                                                        {{ $tugas }}
                                                    </td>
                                                    <td class="px-4 py-4 text-sm text-gray-700 whitespace-nowrap">
                                                        <div class="flex items-center gap-2">
                                                            <input type="number" name="masa[{{ $index }}]"
                                                                class="block w-20 rounded-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                                                value="{{ $masa[$index] }}" placeholder="{{ $masa[$index] }}">
                                                            <span>Jam</span>
                                                        </div>
                                                    </td>
                                                    <td class="px-4 py-4 text-sm text-gray-700 whitespace-nowrap">
                                                        <div class="flex items-center gap-2">
                                                            <span>RM</span>
                                                            <input type="text" value="{{ $harga[$index] }}"
                                                                class="block w-20 rounded-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                                                disabled>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            

                                                @php $counter++ @endphp
                                            @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 lg:max-w-6xl">


        @csrf

        <x-primary-button type="submit" class="mt-4 w-full" id="submit_button">Terima Tempahan</x-primary-button>
        </form>
    </div>

    <script>
        var tasksBackhoe = @json($tasksBackhoe);
        var tasksTracktor = @json($tasksTracktor);
        var allTasks = tasksBackhoe.concat(tasksTracktor);


    </script>

@endsection
