@extends('LKTNbooking/layout')

@section('title', 'LKTNbooking')


@section('header')
    @include('LKTNbooking.partials.navbar')
@endsection

@section('content')


    {{-- Penginapan --}}
    <section class="mt-12  flex flex-col  md:flex md:flex-row-reverse md:justify-center ">

        <div class="p-8 max-w-lg self-center md:max-w-xl ">
            <div class=" flex justify-center gap-8">

                <img src="images\bilik asrama.jpeg" alt="bilik asrama" class="w-1/3 rounded-3xl shadow-lg  object-cover">


                <img src="images\bilik vip.jpeg" alt="bilik vip" class="w-2/3 rounded-3xl shadow-lg  object-cover">

            </div>

            <div class=" pt-10 flex justify-center">

                <img src="images\rumah-tumpangan.jpg" alt="homestay" class="w-4/5 rounded-3xl shadow-lg  object-cover">

            </div>
        </div>



        <div class="flex justify-center items-center ">

            <div class="flex flex-col p-8 md:max-w-md">
                <h1 class="font-bold text-3xl self-center md:self-start md:text-4xl xl:text-5xl  ">Penginapan</h1>
                <p class="leading-loose text-md mt-7 md:text-lg">Nikmati penginapan selesa seperti di rumah. Ada dorm,
                    suite
                    VIP, dan
                    homestay. Rasai keramahan sejati dan cipta kenangan tak terlupakan.</p>
                <div class="flex justify-center">
                    {{-- <button class="mt-8 bg-secondary p-4 text-white rounded-2xl" @click="openHouse = !openHouse">Tempah Sekarang</button> --}}
                    <x-primary-button @click="openHouse=true" class="mt-8 py-4">
                        Tempah Sekarang</x-primary-button>
                </div>


            </div>

        </div>

    </section>

    {{-- Dewan/bilik Kuliah --}}
    <section class=" mt-12 md:mt-48  ">

        <div class=" gap-32 md:flex md:justify-center">
            <div class="flex flex-col items-center">
                <div class="flex  w-max justify-center items-center p-1 rounded-xl">
                    <img src="images\dewan jubli.jpeg" alt="dewan jubli" class="rounded-xl w-72 md:w-96">
                </div>

                <div class="flex mt-10  w-max h-max justify-center items-center p-1 rounded-xl">
                    <img src="images\bilik kuliah.jpeg" alt="bilik kuliah" class="rounded-xl w-72 md:w-96">
                </div>
            </div>


            <div class="mt-10 flex justify-center items-center  ">

                <div class="flex flex-col p-8 md:max-w-md">
                    <h1 class="leading-loose font-bold text-3xl self-center md:self-start md:text-4xl xl:text-5xl">Dewan
                        &
                        <br class="hidden xl:inline">Bilik Kuliah
                    </h1>
                    <p class="leading-loose text-md mt-7 md:text-lg">Ruang kuliah yang nyaman dan lengkap untuk
                        pengalaman
                        belajar yang optimal. Temukan inspirasi baru di sini.</p>
                    <div class="flex justify-center">

                        <x-primary-button @click="openHouse=true"
                            class="mt-8 py-4"> Tempah Sekarang</x-primary-button>

                    </div>
                </div>

            </div>
        </div>


    </section>

    {{-- Jengkaut/Tracktor --}}
    <section class="mt-12 md:mt-48 ">

        <div class="flex flex-col items-center gap-10 md:gap-20 md:flex-row md:justify-center">
            <div class="flex flex-col bg-secondary  h-auto w-72 p-8 rounded-2xl md:h-auto md:w-96">
                <img src="images\excavator.png" alt="" class="mt-5 w-24 md:w-36 self-center">
                <h1 class="mt-5 font-bold text-xl self-center">Jengkaut</h1>
                <p class="text-sm mt-5 leading-loose text-start md:text-base md:leading-loose">Perkhidmatan kami
                    termasuk
                    galian parit, kolam, dan
                    kawasan pembersihan. Dengan
                    kepakaran dan peralatan berkualiti.</p>
            </div>

            <div class="flex flex-col bg-secondary  h-auto w-72 p-8 rounded-2xl md:h-auto md:w-96">
                <img src="images\tractor.png" alt="" class="mt-5 w-24 md:w-36 self-center">
                <h1 class="mt-5 font-bold text-xl self-center">Traktor</h1>
                <p class="text-sm mt-5 leading-loose text-start md:text-base md:leading-loose">Perkhidmatan yang kami
                    tawarkan termasuk tenggala, meracun, dan piring. Kami
                    berkomitmen untuk
                    menyediakan penyelesaian terbaik.
                </p>
            </div>
        </div>

        <div class="flex justify-center">
            <x-primary-button onclick="window.location='{{ route('vehicle.booking.calendar') }}'" class="mt-8 py-4"> Tempah
                Sekarang</x-primary-button>

        </div>

    </section>



@endsection


@section('footer')
    @include('LKTNbooking/partials/footer')
@endsection
