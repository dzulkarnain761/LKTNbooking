<div class="max-w-6xl mx-auto">
    <div>
        <div class="flex justify-between items-center mx-4 h-16 ">


            <div class="flex gap-8 items-end">
                {{-- LOGO --}}
                <div class="">
                    <a href="/"><span class="font-extrabold text-xl">LKTN</span><span
                            class="text-xs font-semibold">booking</span></a>

                </div>
                <style>
                    .underline-animation::before {
                        content: '';
                        display: block;
                        width: 0;
                        height: 3px;
                        background: #050505ee;
                        position: absolute;
                        bottom: -3px;
                        left: 0;
                        transition: width 0.3s ease-in-out;
                    }

                    .underline-animation:hover::before {
                        width: 100%;
                    }
                </style>
                <div>
                    {{-- desktop view --}}
                    <nav class="relative hidden md:block tracking-widest font-medium">
                        <button class="text-xs underline-animation" @click="openTempahan = !openTempahan"
                            @click.outside="openTempahan = false">Tempahan</button>
                        {{-- <a href="{{route('user-dashboard')}}"> <button class="text-xs m-2 hover:underline">Lihat Tempahan</button></a> --}}

                        <div class="absolute left-2 top-13 bg-bgcolor p-2 shadow-xl rounded-sm" x-cloak
                            x-show="openTempahan" x-transition>
                            <button class="block text-xs m-4 hover:underline"
                                @click="openHouse = !openHouse">Penginapan</button>
                            <button class="block text-xs m-4 text-nowrap hover:underline"
                                @click="openHouse = !openHouse">Dewan / Bilik Kuliah</button>
                            <button class="block text-xs m-4 hover:underline"><a
                                    href="{{ route('vehicle.booking.calendar') }}">Jengkaut</a></button>
                            <button class="block text-xs m-4 hover:underline"><a
                                    href="{{ route('vehicle.booking.calendar') }}">Traktor</a></button>
                        </div>
                    </nav>
                </div>
            </div>


            <div class="md:hidden" @click="open = !open">
                <img src ="logo/cross.svg" alt="Hamburger SVG" class="w-10 h-10 " x-cloak x-show="open" />
                <img src ="logo/hamburger-menu.svg" alt="Hamburger SVG" class="w-10 h-10" x-show="!open" />
            </div>





            @if (Route::has('login'))

                @auth
                    @if (Auth::user()->usertype == 'admin')
                        <button onclick="window.location='{{ route('admin.dashboard.pending') }}'"
                            class="hidden md:block px-4 py-1 bg-transparent border border-black rounded-full font-medium text-xs text-black hover:text-white focus:text-white tracking-widest hover:bg-gray-700 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out "
                            type="button">
                            Dashboard
                        </button>
                    @else
                        <button onclick="window.location='{{ route('dashboard.pending') }}'"
                            class="hidden md:block px-4 py-1 bg-transparent border border-black rounded-full font-medium text-xs text-black hover:text-white focus:text-white tracking-widest hover:bg-gray-700 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out "
                            type="button">
                            Dashboard
                        </button>
                    @endif
                @else
                    <button onclick="window.location='{{ route('login') }}'"
                        class="hidden md:block px-4 py-1 bg-transparent border border-black rounded-full font-medium text-xs text-black hover:text-white focus:text-white tracking-widest hover:bg-gray-700 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out "
                        type="button">
                        Log Masuk
                    </button>

                @endauth

            @endif



        </div>

        {{-- mobile  view --}}
        <nav class="ml-2 pb-1 md:hidden absolute bg-bgcolor w-full tracking-widest font-semibold text-xs" x-cloak x-show="open" x-collapse.duration.600ms
            @click.outside="open = false">
            <button class="block py-2 px-2 mx-2  hover:underline"
                @click="openTempahan = !openTempahan">Tempahan</button>
            <div x-show="openTempahan">
                <button class="block py-2 px-2 mx-6  hover:underline"
                    @click="openHouse = !openHouse">Penginapan</button>
                <button class="block py-2 px-2 mx-6  hover:underline"
                    @click="openHouse = !openHouse">Dewan/Bilik Kuliah</button>
                <button class="block py-2 px-2 mx-6  hover:underline"><a
                        href="{{ route('vehicle.booking.calendar') }}">Jengkaut</a></button>
                <button class="block py-2 px-2 mx-6  hover:underline"><a
                        href="{{ route('vehicle.booking.calendar') }}">Traktor</a></button>
            </div>
            <button class="block py-2 px-2 mx-2  hover:underline">Hubungi Kami</button>
            @if (Route::has('login'))
                @auth
                    @if (Auth::user()->usertype == 'admin')
                        <button onclick="window.location='{{ route('admin.dashboard.pending') }}'"
                            class="block py-2 px-2 mx-2  hover:underline">Dashboard</button>
                    @else
                        <button onclick="window.location='{{ route('dashboard.pending') }}'"
                            class="block py-2 px-2  mx-2  hover:underline">Dashboard</button>
                    @endif
                @else
                    <button onclick="window.location='{{ route('login') }}'"
                        class="block py-2 px-2  mx-2 hover:underline">Log Masuk</button>
                @endauth
            @endif

        </nav>

    </div>
</div>
