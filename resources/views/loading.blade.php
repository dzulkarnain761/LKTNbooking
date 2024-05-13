<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loading...</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="">
    <div class="flex items-center justify-center w-full h-full">
        <div class="flex justify-center items-center space-x-1 text-sm text-gray-700">
             
                    <svg fill='none' class="w-6 h-6 animate-spin" viewBox="0 0 32 32" xmlns='http://www.w3.org/2000/svg'>
                        <path clip-rule='evenodd'
                            d='M15.165 8.53a.5.5 0 01-.404.58A7 7 0 1023 16a.5.5 0 011 0 8 8 0 11-9.416-7.874.5.5 0 01.58.404z'
                            fill='currentColor' fill-rule='evenodd' />
                    </svg>
    
             
            <div>Loading ...</div>
        </div>
    </div>
</body>
<script>
    // Wait for 5 seconds before redirecting
    setTimeout(function() {
        window.location.href = "{{ route('dashboard.pending') }}";
    }, 3000); // 5000 milliseconds = 5 seconds
</script>

</html>
