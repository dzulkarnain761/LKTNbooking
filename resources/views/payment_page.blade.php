@extends('LKTNbooking.layout')


{{-- @section('header')
    @include('LKTNbooking.partials.navbar')
@endsection --}}

@section('content')
    <form id="bookingForm" action="{{ route('create.booking.vehicle') }}" method="POST" class="mt-28">
        @csrf

        <div class="mt-10 mb-10 flex flex-col max-w-5xl mx-auto">
            <div class="p-12 bg-white rounded-md shadow-md flex flex-col ">
                <div id="info-container" class="flex flex-col space-y-4">
                    <div class="flex flex-col space-y-4 ">
                        <h1 class="font-bold text-lg">Butiran Tempahan</h1>


                        <div class="flex flex-col space-y-4 md:flex-row md:justify-start md:gap-40 md:items-baseline">

                            <div class="space-y-4">
                                <div class="">
                                    <p class="font-semibold text-xs ">Tarikh Tugasan :</p>
                                    <p class="">{{ $booking->task_date }}</p>
                                </div>
                                <div class="">

                                    <p class="font-semibold text-xs ">Alamat :</p>
                                    <p class="">{{ $booking->location }} , {{ $booking->district }},
                                        {{ $booking->state }}</p>
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

                            </div>

                        </div>



                        <h1 class="text-md font-semibold">Butiran Harga</h1>

                        <div class="mt-4">
                            @php
                                $tugasan = explode(',', $booking->task);
                                $masa_tugasan = explode(',', $booking->estimated_time);
                                $harga = explode(',', $booking->estimated_cost);

                                $counter = 1;
                                $total_harga = 0;
                            @endphp
                            <div>
                                @foreach ($tugasan as $index => $tugas)
                                    <div class="flex justify-between">
                                        <p>{{ $counter }}. {{ $tugas }} ({{ $masa_tugasan[$index] }})</p>
                                        <span>RM {{ $harga[$index] }}</span>
                                    </div>
                                    @php
                                        $counter++;
                                        $total_harga += (float) $harga[$index];
                                    @endphp
                                @endforeach
                            </div>

                        </div>

                        <hr class="border border-slate-400 mt-8">

                        <div class="flex justify-between mt-4">
                            <p class="mt-1">Jumlah Harga</p>
                            <p class="mt-1">RM {{ $total_harga }} </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <div class="mt-10 mb-10 flex flex-col max-w-5xl mx-auto">
            <div class="p-12 bg-white rounded-md shadow-md flex flex-col ">
                <div id="info-container" class="flex flex-col space-y-4">
                    <div class="flex flex-col space-y-4 ">
                        <h1 class="font-bold text-lg">Pilih Cara Pembayaran</h1>

                        <div x-data="{ paymentType: '1' }" class="flex flex-col gap-4 max-w-md">

                            <div class=" w-full ">
                                <label class="text-sm text-gray-800">Cara Pembayaran</label>
                                <div class="mt-1">
                                    <select x-model="paymentType"
                                        class="mt-1 block w-full rounded-md border border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                        <option value="1">Pembayaran Tunai</option>
                                        <option value="2">Credit/Debit</option>
                                        <option value="3">Online Banking</option>
                                        
                                    </select>
                                </div>
                            </div>
                            <template x-if="paymentType == 3">
                                <div class="w-full ">
                                    <label class="text-sm text-gray-800">Pilih Bank</label>
                                    <div class="mt-1">
                                        <select
                                            class="mt-1 block w-full rounded-md border border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                            <option value="MAYBANK">Maybank</option>
                                            <option value="CIMB">Cimb</option>
                                            <option value="BANK_ISLAM">Bank Islam</option>
                                        </select>
                                    </div>
                                </div>
                            </template>
                            <template x-if="paymentType == 2">
                                <form class="flex flex-wrap gap-3 ">
                                    <label class="relative w-full flex flex-col">
                                        <span class="text-sm tracking-wide">Card number</span>
                                        <input
                                            class="mt-1 rounded-md peer pl-12 pr-2 py-2 border border-gray-200 placeholder-gray-300"
                                            type="text" name="card_number" placeholder="0000 0000 0000" />
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="absolute bottom-0 left-0 -mb-0.5 transform translate-x-1/2 -translate-y-1/2 text-black peer-placeholder-shown:text-gray-300 h-6 w-6"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                        </svg>
                                    </label>

                                    <label class="relative flex-1 flex flex-col">
                                        <span class=" text-sm tracking-wide">Expire date</span>
                                        <input
                                            class="mt-1 rounded-md peer pl-12 pr-2 py-2 border border-gray-200 placeholder-gray-300"
                                            type="text" name="expire_date" placeholder="MM/YY" />
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="absolute bottom-0 left-0 -mb-0.5 transform translate-x-1/2 -translate-y-1/2 text-black peer-placeholder-shown:text-gray-300 h-6 w-6"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </label>

                                    <label class="relative flex-1 flex flex-col">
                                        <span class="text-sm tracking-wide">
                                            CVC/CVV
                                        </span>
                                        <input
                                            class="mt-1 rounded-md peer pl-12 pr-2 py-2 border border-gray-200 placeholder-gray-300"
                                            type="text" name="card_cvc" placeholder="&bull;&bull;&bull;" />
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="absolute bottom-0 left-0 -mb-0.5 transform translate-x-1/2 -translate-y-1/2 text-black peer-placeholder-shown:text-gray-300 h-6 w-6"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                        </svg>
                                    </label>
                                </form>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-10 mb-10 flex flex-col max-w-5xl mx-auto">
            <x-primary-button id="submitButton" class="submitButton">Teruskan Tempahan</x-primary-button>

            <x-primary-button id="loadingButton" class="hover:cursor-not-allowed" disabled style="display: none;">
                <div class="flex items-center justify-center">
                    <div class="h-4 w-4 border-t-transparent border-solid animate-spin rounded-full border-white border-4">
                    </div>
                    <div class="ml-2"> Processing... </div>
                </div>
            </x-primary-button>
        </div>


    </form>


    {{-- <script>
        let district = @json($district);
        let selectState = document.getElementById('state');
        let selectDistrict = document.getElementById('district');

        // Initialize district value based on the initially selected state
        let initialState = selectState.value;
        let initialDistricts = district.filter(function(district) {
            return district.state === initialState;
        });

        // Populate the district dropdown with the initial districts
        initialDistricts.forEach(function(district) {
            let option = document.createElement('option');
            option.value = district.district;
            option.text = district.district;
            selectDistrict.appendChild(option);
        });

        selectState.addEventListener('change', function() {
            let selectedState = this.value;
            let districtsForState = district.filter(function(district) {
                return district.state === selectedState;
            });

            // clear the district dropdown
            selectDistrict.innerHTML = '';

            // populate the district dropdown with the filtered districts
            districtsForState.forEach(function(district) {
                let option = document.createElement('option');
                option.value = district.district;
                option.text = district.district;
                selectDistrict.appendChild(option);
            });
        });

        document.getElementById('submitButton').addEventListener('click', function() {
            // Hide the submit button
            const form = document.getElementById('bookingForm');

            // Check if the form is valid
            if (form.checkValidity()) {
                // Prevent the default form submission
                event.preventDefault();

                // Hide the submit button
                this.style.display = 'none';

                // Show the loading button
                document.getElementById('loadingButton').style.display = '';

                // Submit the form or make the API call here
                // For example, if you're using a form:
                form.submit();

                // If you're making an API call, initiate it here
            } else {
                // If the form is not valid, show the default validation messages
                form.reportValidity();
            }
        });
    </script> --}}
@endsection
