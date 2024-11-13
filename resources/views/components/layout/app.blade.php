<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    @php
    $manifest = json_decode(file_get_contents(__DIR__ . '/../../../public/build/manifest.json'), true);
    $app_css = file_get_contents(__DIR__ . '/../../../public/build/' . $manifest['resources/css/app.css']['file']);
    @endphp

    @persist('styles')
    <style>
        {!! $app_css  !!}
    </style>
    @endpersist('styles')

    @vite(['resources/js/app.js'])

    @livewireStyles

    @stack('head')
</head>

<body>

    <x-navbar />

    <div class="gap-3 lg:grid lg:grid-cols-4">
        @persist('sidebar')
        <livewire:sidebar />
        @endpersist

        <main class="py-3 lg:col-span-3">
            {{$slot}}
        </main>
    </div>

    @livewireScripts
</body>

</html>