<!doctype html>
<html lang="{{ App::getLocale() }}" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'Les Pattes Heureuses' }}</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js" defer type="module"></script>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    {{ $head ?? '' }}
</head>
<body class="bg-white overflow-visible min-w-sm" x-data="{ menuOpen: false }"
      x-effect="document.body.style.overflow = menuOpen ? 'hidden' : ''">

    <livewire:admin.partials.header/>

    <div class="flex row-reverse h-[calc(100vh-5.6rem)] bg-grayscale-negative">

        <livewire:admin.navigation.sidebar/>

        <div class="flex-1 flex flex-col min-h-[calc(100vh-5.6rem)] overflow-y-auto">
            {{ $slot }}

            <x-admin.partials.footer/>
        </div>


    </div>

    <livewire:global-modal />
</body>
</html>

