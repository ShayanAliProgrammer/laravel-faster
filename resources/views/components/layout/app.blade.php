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
        $app_js = file_get_contents(__DIR__ . '/../../../public/build/' . $manifest['resources/js/app.js']['file']);
    @endphp

    <style>
        {!! $app_css !!}
    </style>

    <script defer>{!! $app_js !!}</script>

    @livewireStyles
</head>
<body>

    <x-navbar />

    {{$slot}}

    @livewireScripts
</body>
</html>