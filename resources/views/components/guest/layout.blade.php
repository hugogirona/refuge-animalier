<!doctype html>
<html lang="{{ App::getLocale() }}" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'Les Pattes Heureuses' }}</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    {{ $head ?? '' }}
</head>
<body class="bg-grayscale-negative mt-16" style="min-height: calc(100vh - 4rem); min-width: 370px">

<x-guest.partials.header></x-guest.partials.header>

<main>
    {{ $slot }}
</main>

<x-guest.partials.footer></x-guest.partials.footer>

</body>
</html>
