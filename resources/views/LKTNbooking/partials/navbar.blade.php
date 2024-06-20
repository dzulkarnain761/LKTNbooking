<div class="max-w-6xl mx-auto">
    <div>
        <div class="flex justify-between items-center mx-4 h-16 ">


            <div class="flex gap-8">
                {{-- LOGO --}}
                <div class="">
                    <a href="/"><span class="font-extrabold text-xl">LKTN</span><span
                            class="text-xs font-semibold">booking</span></a>

                </div>


                {{-- desktop view --}}
                <nav class="relative hidden md:block">
                    <button class="text-xs m-2 hover:underline" @click="openTempahan = !openTempahan"
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


            <div class="md:hidden" @click="open = !open">
                <img src ="logo/cross.svg" alt="Hamburger SVG" class="w-10 h-10 " x-cloak x-show="open" />
                <img src ="logo/hamburger-menu.svg" alt="Hamburger SVG" class="w-10 h-10" x-show="!open" />
            </div>


            <div class="hidden md:block border border-black rounded-full">
                {{-- <button class="block px-4 py-2  text-xs hover:underline"
                    @click="openLogin = !openLogin">Log Masuk</button> --}}

                @if (Route::has('login'))
                    <nav class="">
                        @auth
                            @if (Auth::user()->usertype == 'admin')
                                <a href="{{ url('admin/dashboard-pending') }}"
                                    class="px-6 py-2 text-sm hover:underline">Dashboard</a>
                            @else
                                <a href="{{ url('/dashboard-pending') }}"
                                    class="px-6 py-2 text-sm hover:underline">Dashboard</a>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class=" px-6 py-2 text-sm hover:underline">
                                Log Masuk
                            </a>
                        @endauth
                    </nav>
                @endif
            </div>

        </div>

        {{-- mobile  view --}}
        <nav class="ml-2 pb-1 md:hidden absolute bg-bgcolor w-full" x-cloak x-show="open" x-collapse.duration.600ms
            @click.outside="open = false">
            <button class="block py-2 px-2 mx-2  hover:underline text-sm"
                @click="openTempahan = !openTempahan">Tempahan</button>
            <div x-show="openTempahan">
                <button class="block py-2 px-2 mx-6  hover:underline text-sm"
                    @click="openHouse = !openHouse">Penginapan</button>
                <button class="block py-2 px-2 mx-6  hover:underline text-sm"
                    @click="openHouse = !openHouse">Dewan/Bilik Kuliah</button>
                <button class="block py-2 px-2 mx-6  hover:underline text-sm"><a
                        href="{{ route('vehicle.booking.calendar') }}">Jengkaut</a></button>
                <button class="block py-2 px-2 mx-6  hover:underline text-sm"><a
                        href="{{ route('vehicle.booking.calendar') }}">Traktor</a></button>
            </div>
            <button class="block py-2 px-2 mx-2  hover:underline text-sm">Hubungi Kami</button>
            @if (Route::has('login'))
                @auth
                    @if (Auth::user()->usertype == 'admin')
                        <button onclick="window.location='{{ url('admin/dashboard-pending') }}'"
                            class="block py-2 px-2 mx-2  hover:underline text-sm">Dashboard</button>
                    @else
                        <button onclick="window.location='{{ url('/dashboard-pending') }}'"
                            class="block py-2 px-2  mx-2  hover:underline text-sm">Dashboard</button>
                    @endif
                @else
                    <button onclick="window.location='{{ route('login') }}'"
                        class="block py-2 px-2  mx-2 hover:underline text-sm">Log Masuk</button>
                @endauth
            @endif

        </nav>

    </div>
</div>
