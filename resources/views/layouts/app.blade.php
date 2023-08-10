<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="https://upload.wikimedia.org/wikipedia/commons/thumb/7/7c/Flag-map_of_Madagascar.svg/1200px-Flag-map_of_Madagascar.svg.png" >
    <title>Laravel WebMapping M2</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @stack('styles')
    @stack('scripts')
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>
<body class="font-sans antialiased overflow-y-hidden">
    <div>
        <main class="py-3">
            <div class="relative mx-auto border-gray-800 bg-gray-800 border-[16px] rounded-t-xl h-[85vh] w-[90%]">
                <h1 class="text-3xl text-center font-extrabold text-white">Visualisation d'<span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400"> Anosizato</span> </h1>
                <div class="rounded-xl overflow-hidden">
                    {{ $slot }}
                </div>
            <div class="flex justify-end px-3">
                <div class="text-sm flex gap-5">
                    <span class="bg-gray-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">Laravel 10</span>
                    <span class="bg-gray-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">PostgreSql</span>
                    <span class="bg-gray-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">PostGis</span>
                    <span class="bg-gray-100 text-gray-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">OpenLayers</span>
                    <span class="bg-gray-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">OpenStreetMap</span>
                    <span class="bg-gray-100 text-purple-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">Geoserver</span>
                </div>
            </div>
            </div>
            <div class="relative mx-auto bg-gray-900 rounded-b-xl h-[24px] max-w-[301px] md:h-[42px] md:max-w-[512px]"></div>
            <div class="relative mx-auto bg-gray-800 rounded-b-xl h-[30px] max-w-[83px] md:h-[95px] md:max-w-[142px]"></div>

        </main>
    </div>

    @stack('modals')

    @livewireScripts
</body>
</html>
