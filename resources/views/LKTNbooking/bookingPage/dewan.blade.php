@extends('LKTNbooking/layout')

@section('title', 'LKTNbooking-dewanbooking')

@section('content')
    <section class="mt-16 " >
        <div class="flex justify-center">
            <h1 class="font-bold text-xl md:text-2xl">Tempahan Dewan</h1>
        </div>


        <form method="POST" action="/payment-page">

            @csrf
            <div class="flex justify-center mt-8">
                <div class="flex flex-col w-72 items-center bg-white p-4 rounded-xl shadow-md">

                    {{-- <p id="tarikhMasuk"></p> --}}
                    <p>Tarikh Masuk : {{ $tarikhMasuk }} </p>
                    <p>Tarikh Keluar : {{ $tarikhAkhir }} </p>
                    <p>Tempoh : {{ $tempohSewa }} Hari</p>


                </div>
            </div>

            <div class="flex flex-col items-center gap-8 mt-8">
                @foreach ($rooms as $room)
                <div class="bg-tertiary flex flex-col p-4 rounded-xl w-auto  sm:flex-row sm:justify-between sm:w-160 ">

                    <div class="sm:flex">
                        <div>
                            <img src="{{ $room['image'] }}" alt="{{ $room['name'] }}" class="rounded-xl w-52 h-40 object-cover">
                        </div>
                    
                        <div class="mt-5 self-start sm:mt-0  sm:flex sm:flex-col sm:gap-4 sm:ml-8">
                            <h1 class="font-bold text-lg text-ellipsis ">{{ $room['name'] }}</h1>
                            <p class="text-sm font-semibold text-gray-500">{{ $room['bedType'] }}</p>
                            <p class="text-sm font-semibold text-gray-500">{{ 'Kapasiti: ' . $room['capacity'] }}</p>
                            <p class="text-sm font-semibold text-gray-500">{{ 'Kuantiti : ' . $room['quantity'] }}</p>
                        </div>
                    </div>
                    
                
                    <div class="flex justify-between mt-5 sm:flex-col sm:mt-0 sm:justify-start "> 
                        <div class="self-end">
                            <h1 class="font-bold text-xl sm:text-3xl text-red-700">{{ 'RM' . $room['price'] }}</h1>
                        </div>
                
                        <div x-data="{ count: 0 }" class="flex flex-row sm:mt-8 ">
                            <button type="button" class="bg-red-300  w-8 h-8 rounded-l cursor-pointer  sm:h-10"
                                @click="count > 0 ? count-- : null">
                                <span class="m-auto text-xl font-thin">-</span>
                            </button>
                            <input readonly type="number" class="text-center w-8 h-8  sm:h-10"
                                x-model.number="count"></input>
                            <button type="button" class="bg-blue-300  w-8 h-8 rounded-r cursor-pointer  sm:h-10"
                                @click="count < {{ $room['quantity'] }} ? count++ : null">
                                <span class="m-auto text-xl font-thin">+</span>
                            </button>
                        </div>
                        <input type="hidden">
                    </div>
                </div>
                @endforeach

            </div>

            <div class="flex justify-center mb-10">
                <input type="hidden" name="jenisSewa" value="penginapan" >
                <button type="submit" class="mt-12 bg-primary p-4 text-white rounded-2xl">
                    Sahkan Tempahan
                </button>
            </div>
        </form>
    </section>


@endsection
