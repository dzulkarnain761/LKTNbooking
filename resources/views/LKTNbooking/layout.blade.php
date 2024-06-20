<!DOCTYPE html>
<html lang="en" class="scroll-smooth snap-proximity snap-y ">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'LKTN booking')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')


    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

</head>

<body class="font-poppins bg-bgcolor">

    <div x-data="{
    
        open: false,
        openLogin: false,
        openTempahan: false,
        openHouse: false,
        openTraktor: false,
        sewatype: 'booking-penginapan',
        vehicletyle: 'booking-jengkaut',
        checkInDate: new Date().toISOString().split('T')[0],
    
    }">
        <header class="shadow-sm sticky top-0 bg-bgcolor z-50">
            @yield('header')
        </header>

        <main class="snap-y">
            @yield('content')
        </main>

        <footer">
            @yield('footer')
        </footer>

            {{-- @include('LKTNbooking/partials/modals') --}}
    </div>

</body>

</html>
