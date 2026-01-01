<!doctype html>
<html lang="{{ App::getLocale() }}" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="robots" content="noindex, nofollow">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="description" content="{{__('head.description')}}">
    <meta name="keywords" content="{{ __('head.keywords') }}">

    <title>{{ $title ? $title . ' | Admin' : 'Administration - Les Pattes Heureuses' }}</title>

    <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
    <link rel="manifest" href="/site.webmanifest" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <script src="https://cdn.jsdelivr.net/npm/chart.js" defer></script>

    {{ $head ?? '' }}
</head>
<body class="bg-white overflow-visible min-w-[360px]" x-data="{ menuOpen: false }"
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
