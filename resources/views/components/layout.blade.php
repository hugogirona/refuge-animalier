@props([
    'title' => 'Les pattes heureuses',
    'type' => 'base'
])

    <!doctype html>
<html lang="{{ App::getLocale() }}" class="h-full scroll-smooth">
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
<body class="bg-white overflow-visible" x-data="{ menuOpen: false }" x-effect="document.body.style.overflow = menuOpen ? 'hidden' : ''">

    <x-guest.partials.header></x-guest.partials.header>

    <main class="pt-16 md:pt-20 overflow-visible">
        {{ $slot }}
    </main>

    <x-guest.partials.footer></x-guest.partials.footer>
</body>
</html>
