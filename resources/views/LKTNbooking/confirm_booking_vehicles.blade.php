@extends('LKTNbooking.layout')

@section('content')
    @php

        $userid = Auth::user()->id;
        $name = Auth::user()->name;
        $email = Auth::user()->email;
        $phone_number = Auth::user()->phone_number;

    @endphp
    
    <section class="mt-10 mb-10">
        <form action="/proceed-booking" method="POST">
            @csrf

            <div class="flex flex-col items-center">

                <div class="w-5/6 max-w-xl flex flex-col">
                    <h1 class="text-md font-bold">Tempahan Anda</h1>
                    <p class="text-xs font-semibold text-gray-500">Pastikan semua butiran di halaman ini adalah betul sebelum
                        meneruskan pembayaran.</p>
                    <div class=" bg-white rounded-xl p-8 border border-black mt-4 mb-4">
                        <div class="flex flex-col gap-2">
                            <label for="name" class="text-sm">Nama Penuh :</label>
                            <input type="text" class="border border-black rounded-md p-2 md:w-2/3"
                                value="{{ $name }}" readonly>
                            <label for="" class="text-sm">Email (Optional) :</label>
                            <input type="text" class="border border-black rounded-md p-2 md:w-1/2"
                                placeholder="{{ $email }}">
                            <label for="" class="text-sm">No Telefon :</label>
                            <input type="text" class="border border-black rounded-md p-2 w-2/3 md:w-1/3"
                                value="{{ $phone_number }}" readonly>
                        </div>


                    </div>


                    <div class=" bg-white rounded-xl p-8 border border-black mt-4 ">
                        <h1 class="text-md font-bold">Butiran Tempahan</h1>
                        <div class=" sm:flex sm:justify-between ">
                            <div>
                                <p class="mt-1">Servis : {{ $jenisServis }} </p>
                                <p class="mt-1">Tarikh : {{ $tarikhTempahan }} </p>
                                <p class="mt-1">Keluasan : {{ $keluasanTanah }} Hektar </p>
                            </div>
                            <div class="">
                                <p class="mt-1">Daerah : {{ $daerah }}, {{ $negeri }}</p>
                                <p class="mt-1">Lokasi : {{ $lokasiTugas }} </p>
                            </div>

                        </div>

                        {{-- <hr class="border border-slate-400 mt-4"> --}}

                        <h1 class="text-md font-bold mt-8 mb-2">Butiran Harga</h1>

                        @php
                            $tugasan = explode(',', $pilihanTugas);
                            $totalPrice = 0;
                        @endphp

                        @foreach ($tugasan as $tugas)
                            <div class="flex justify-between">
                                <p class="mt-1">{{ $tugas }}</p>
                                @php
                                    $harga = $jenisServis == 'Jengkaut' ? 40 : 100;
                                    $totalPrice += $harga;
                                @endphp
                                <p class="mt-1">RM{{ $harga }}</p>
                            </div>
                        @endforeach

                        <hr class="border border-slate-400 mt-8">

                        <div class="flex justify-between mt-4">
                            <p class="mt-1 ">Jumlah Harga</p>
                            <p class="mt-1 ">RM {{ $totalPrice }}</p>
                        </div>
                    </div>
                    <input type="hidden" name="user-id" value="{{$userid}}">
                    <input type="hidden" name="negeri" value="{{$negeri}}">
                    <input type="hidden" name="daerah" value="{{$daerah}}">
                    <input type="hidden" name="task-date" value="{{$tarikhTempahan}}">
                    <input type="hidden" name="kawasan" value="{{$lokasiTugas}}">
                    <input type="hidden" name="keluasan" value="{{$keluasanTanah}}">
                    <input type="hidden" name="servis-type" value="{{$jenisServis}}">
                    <input type="hidden" name="tugas" value="{{$pilihanTugas}}">

                    <x-primary-button type="submit" class="mt-8 ">
                        Sahkan Tempahan
                    </x-primary-button>
                </div>

            </div>
        </form>
    </section>
@endsection
