@extends('LKTNbooking.layout')


@section('header')
    @include('LKTNbooking.partials.navbar')
@endsection

@section('content')
    @php

        $userid = Auth::user()->id;
        $name = Auth::user()->name;
        $email = Auth::user()->email;
        $phone_number = Auth::user()->phone_number;

    @endphp


    <form id="bookingForm" action="{{ route('create.booking.vehicle') }}" method="POST">
        @csrf

        <div class="mt-10 mb-10 flex flex-col max-w-5xl mx-auto">
            <div class="p-8 bg-white rounded-md shadow-md flex flex-col ">
                <div id="info-container" class="flex flex-col space-y-4">
                    <div class="flex flex-col space-y-4 max-w-2xl">
                        <h1 class="font-bold text-lg">Isi Maklumat Tugasan</h1>
                        <br>

                        <div class="flex flex-col md:flex-row md:justify-between">
                            <div class=" px-3 py-2">Negeri :</div>
                            <div class="w-full md:w-3/5">

                                <select id="state" name="state" class="w-full border shadow-sm px-3 py-2 rounded-md">
                                    @foreach ($states as $state)
                                        <option value="{{ $state }}">{{ $state }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="flex flex-col md:flex-row md:justify-between">
                            <div class=" px-3 py-2">Daerah :</div>
                            <div class="w-full md:w-3/5">
                                <select id="district" name="district" class="w-full border shadow-sm px-3 py-2 rounded-md">
                                </select>
                            </div>
                        </div>
                        <div class="flex flex-col md:flex-row md:justify-between">
                            <div class=" px-3 py-2">Lokasi Tugas :</div>
                            <div class="w-full md:w-3/5">
                                <input type="text" name="location" required
                                    class="w-full border shadow-sm px-3 py-2 rounded-md  placeholder-gray-500"
                                    placeholder="Lokasi Tugas" />
                            </div>
                        </div>
                        <div class="flex flex-col md:flex-row md:justify-between">
                            <div class=" px-3 py-2">Keluasan Tanah (Hektar):</div>
                            <div class="w-full md:w-3/5">
                                <input type="number" name="land_size" required min="1"
                                    class="w-full border shadow-sm px-3 py-2 rounded-md  placeholder-gray-500"
                                    placeholder="Keluasan Tanah" />
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>


        <div class="mt-10 mb-10 flex flex-col max-w-5xl mx-auto">
            <div class="p-8 bg-white rounded-md shadow-md flex flex-col ">
                <div id="info-container" class="flex flex-col space-y-4">
                    <div class="flex flex-col space-y-4 max-w-2xl">
                        <h1 class="font-bold text-lg">Maklumat Anda</h1>
                        <br>

                        <div class="flex flex-col md:flex-row md:justify-between">
                            <div class=" px-3 py-2">Nama :</div>
                            <div class="w-full md:w-3/5">
                                <input type="text"
                                    class="w-full border shadow-sm px-3 py-2 rounded-md  placeholder-gray-500"
                                    placeholder="Nama" value="{{ $name }}" disabled />
                            </div>
                        </div>
                        <div class="flex flex-col md:flex-row md:justify-between">
                            <div class=" px-3 py-2">No. Telefon : </div>
                            <div class="w-full md:w-3/5">
                                <input type="text"
                                    class="w-full border shadow-sm px-3 py-2 rounded-md  placeholder-gray-500"
                                    placeholder="No Tel" value="{{ $phone_number }}" disabled />
                            </div>
                        </div>
                        <div class="flex flex-col md:flex-row md:justify-between">
                            <div class=" px-3 py-2">E mail :</div>
                            <div class="w-full md:w-3/5">
                                <input type="text"
                                    class="w-full border shadow-sm px-3 py-2 rounded-md  placeholder-gray-500"
                                    placeholder="E mail" value="{{ $email }}" disabled />
                            </div>
                        </div>
                        <br>
                        <p>*Sila Kemaskini Maklumat Anda di 'Dashboard'.</p>

                        <input type="hidden" value="{{ $userid }}" name="userid">
                        <input type="hidden" value="{{ $selectedDate }}" name="selectedDate">
                        <input type="hidden" value="{{ $selectedTask }}" name="selectedTask">
                        <input type="hidden" value="{{ $selectedVehicle }}" name="selectedVehicle">

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

    <script>
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
    </script>
@endsection
