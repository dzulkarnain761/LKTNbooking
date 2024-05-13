@extends('LKTNbooking.layout')

@section('content')
    <section class="mt-10 mb-10">

        <div class="flex flex-col items-center">

        
            <div class="w-5/6 max-w-xl flex flex-col">
                <h1 class="text-md font-bold">Tempahan Anda</h1>
                <p class="text-xs font-semibold text-gray-500">Pastikan semua butiran di halaman ini adalah betul sebelum
                    meneruskan pembayaran.</p>
                <div class=" bg-white rounded-xl p-8 border border-black mt-4 mb-4">
                    <form action="" class="flex flex-col gap-2">
                        <label for="" class="text-sm">Nama Penuh :</label>
                        <input type="text" class="border border-black rounded-md p-2 md:w-2/3" placeholder="John Doe">

                        <label for="" class="text-sm">E-Mail :</label>
                        <input type="text" class="border border-black rounded-md p-2 md:w-1/2"
                            placeholder="yourname@gmail.com">
                        <label for="" class="text-sm">Phone Number:</label>
                        <input type="text" class="border border-black rounded-md p-2 w-2/3 md:w-1/3"
                            x-mask="999-999999999" placeholder="012-3456789">
           
                    </form>
                </div>


                <div class=" bg-white rounded-xl p-8 border border-black mt-4 ">

                    <h1 class="text-md font-bold">Butiran Tempahan</h1>
                    <div class="flex justify-between mt-2">
                        <div>
                            <p class="mt-1">Tarikh Masuk : {{ $checkin }} </p>
                            <p class="mt-1">Tarikh Keluar : {{ $checkout }} </p>
                            <p class="mt-1">Tempoh : {{ $tempoh }} Hari </p>
                        </div>

                    </div>

                    {{-- <hr class="border border-slate-400 mt-4"> --}}

                    <h1 class="text-md mt-8 font-bold">Butiran Harga</h1>

                    <div class="mt-4">
                        @php
                        $prices = [
                            'Bilik VIP' => $rooms['Bilik VIP'] * 45,
                            'Bilik Asrama' => $rooms['Bilik Asrama'] * 70,
                            'Rumah Tumpangan' => $rooms['Rumah Tumpangan'] * 160,
                        ];

                        $totalPrice = array_sum($prices);

                        $totalPricePlusTempoh = $totalPrice * $tempoh;
                    @endphp

                    @foreach ($prices as $roomType => $price)
                        @if ($rooms[$roomType])
                            <div class="flex justify-between">
                                <p class="mt-1">{{ $roomType }} <span class="ml-2"> ({{ $rooms[$roomType] }})</span>
                                </p>
                                <p class="mt-1">RM {{ $price }}</p>
                            </div>
                        @endif
                    @endforeach
                    </div>

                
                    <hr class="border border-slate-400 mt-8">

                    

                    <div class="flex justify-between mt-4">
                        <p class="mt-1">Jumlah Harga</p>
                        <p class="mt-1">RM {{ $totalPrice }} </p>
                    </div>

                    <div class="flex justify-between ">
                        <p class="mt-1"></p>
                        <p class="mt-1">x{{ $tempoh }} Hari </p>
                    </div>

                    <div class="flex justify-between ">
                        <p class="mt-1"></p>
                        <p class="mt-1 font-bold">RM {{ $totalPricePlusTempoh }}</p>
                    </div>

                </div>

                <x-primary-button type="submit" class="mt-12">
                    Teruskan Tempahan
                </x-primary-button>
            </div>

        </div>
    </section>
@endsection
