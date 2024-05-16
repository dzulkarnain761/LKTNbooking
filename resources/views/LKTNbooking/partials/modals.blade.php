{{--  Login Modal --}}
<div x-cloak x-show="openLogin" x-trap="openLogin" class="fixed w-full h-full top-0 left-0 flex items-center">
    <div class="absolute w-full h-full bg-gray-900 opacity-40"></div>

    <div
        class="relative bg-white border border-black p-10 md:max-w-md mx-auto rounded-xl z-50 flex justify-center items-center w-4/5">
        <button button="type" @click="openLogin = false">
            <img src="logo\cross.svg" alt="pangkah" class="h-8 w-8 absolute right-2 top-2">
        </button>


        <div class="flex flex-col w-full mx-8">
            <form method="GET" action="/another-page">

                @csrf
                <label for="fname" class="text-sm">Email/Phone Number :</label>
                <input type="text" id="fname" name="fname" placeholder="yourname@email.com"
                    class="border border-black rounded-xl p-2 mt-2 w-full text-sm">
                <button class="bg-primary text-white text-xs px-20 py-3 rounded-xl border mt-3 w-full">Log
                    Masuk</button>
            </form>
        </div>
    </div>
</div>



{{-- Penginapan/Dewan Modal --}}
<div x-cloak x-show="openHouse" x-trap="openHouse" class="fixed w-full h-full top-0 left-0 flex items-center">
    <div class="absolute w-full h-full bg-gray-900 opacity-40"></div>

    <div
        class="relative bg-white border border-black p-10 md:max-w-md mx-auto rounded-xl z-50 flex justify-center items-center w-4/5">
        <button type="button" @click="openHouse = false" tabindex="0" class="absolute right-2 top-2 focus:outline-blue-700">
            <img src="logo\cross.svg" alt="pangkah" class="h-8 w-8">
        </button>


        <div class="flex flex-col w-full mx-8">
            <form method="GET" action="/booking-penginapan">
                @csrf
                <label for="sewaan" class="text-sm">Jenis Sewaan :</label>

                <div class="mb-2">
                    <select name="sewa-type" x-model="sewatype"
                        class="w-full border p-2 mt-2 border-black rounded-xl bg-transparent text-gray-600 text-sm">
                        <option value="booking-penginapan">Penginapan</option>
                        <option value="booking-dewan">Dewan/Bilik Kuliah</option>
                    </select>
                </div>
                <label for="check-in" class="text-sm">Tarikh :</label>
                <input type="date" name="tarikh-sewa" x-model="checkInDate" min="{{ date('Y-m-d') }}"
                    class="w-full border border-black p-2 mt-2 mb-2 rounded-xl text-sm" />
                <label for="duration" class="text-sm">Tempoh :</label>
                <div class="mb-2">
                    <select id="tempoh-sewa" name="tempoh-sewa"
                        class="w-full border p-2 mt-2 mb-2 border-black rounded-xl bg-transparent text-gray-600 text-sm">
                        <template x-for="i in 7">
                            <option x-text="i"></option>
                        </template>

                    </select>
                </div>

                {{-- <button type="submit"
                    class="bg-primary text-white text-xs px-20 py-3 rounded-xl border mt-3 w-full">Teruskan</button> --}}
                
                    <x-primary-button class="w-full mt-4 py-3">teruskan</x-primary-button>
                
                
            </form>
        </div>

    </div>
</div>


{{-- jengkaut/tracktor Modal --}}
<div x-cloak x-show="openTraktor" x-trap="openTraktor" class="fixed w-full h-full top-0 left-0 flex items-center">
    <div class="absolute w-full h-full bg-gray-900 opacity-40"></div>
    <div
        class="relative bg-white border border-black p-10 md:max-w-md mx-auto rounded-xl z-50 flex justify-center items-center w-4/5">
        <button type="button" @click="openTraktor = false" tabindex="0" class="absolute right-2 top-2 focus:outline-blue-700">
            <img src="logo\cross.svg" alt="pangkah" class="h-8 w-8">
        </button>


        <div class="flex flex-col w-full mx-8">
            <form method="GET" action="/booking-jengkaut">

                @csrf
                <label for="sewaan" class="text-sm">Jenis Sewaan :</label>

                <div class="mb-2">
                    <select id="vehicle-type" name="vehicle-type"
                        class="w-full border p-2 mt-2 border-black rounded-xl bg-transparent text-gray-600 text-sm">
                        <option value="booking-jengkaut">Jengkaut</option>
                        <option value="booking-traktor">Traktor</option>
                    </select>
                </div>
                <label for="lokasi" class="text-sm">Lokasi :</label>

                <div class="mb-2">
                    <select id="negeri-pilihan" name="negeri-pilihan"
                        class="w-full border p-2 mt-2 border-black rounded-xl bg-transparent text-gray-600 text-sm">
                        <option>Kelantan</option>
                        <option>Terengganu</option>
                    </select>
                </div>
                <label for="check-in" class="text-sm">Tarikh Mula :</label>
                <input type="date" name="tarikh-sewa" x-model="checkInDate" min="{{ date('Y-m-d') }}"
                    class="w-full border border-black p-2 mt-2 mb-2 rounded-xl text-sm" />
                <label for="keluasan-tanah" class="text-sm">Keluasan (Hektar) :</label>
                <div class="mb-2">
                    <select id="keluasan-tanah" name="keluasan-tanah"
                        class="w-full border p-2 mt-2 mb-2 border-black rounded-xl bg-transparent text-gray-600 text-sm">
                        <template x-for="i in 7">
                            <option x-text="i"></option>
                        </template>


                    </select>
                </div>

                
                   
                {{-- <button type="submit"
                    class="bg-primary text-white text-xs px-20 py-3 rounded-xl border mt-3 w-full">Teruskan</button> --}}
                    <x-primary-button class="w-full mt-4 py-3">teruskan</x-primary-button>
            </form>
        </div>

    </div>
</div>




<script></script>
