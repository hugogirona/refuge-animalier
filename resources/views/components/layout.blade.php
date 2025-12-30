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
<body class="bg-white overflow-visible min-w-[360px]" x-data="{ menuOpen: false }"
      x-effect="document.body.style.overflow = menuOpen ? 'hidden' : ''">

<a href="#main-content"
   title="{{ __('link-title.main-content') }}"
   class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-[45%] focus:z-50 focus:px-4 focus:py-2 focus:bg-white focus:text-primary-surface-default-light focus:font-bold focus:shadow-lg focus:rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-surface-default transition-transform">
    {{ __('link-title.main-content') }}
</a>

@if(request()->routeIs('login') || request()->routeIs('password.request') )
    <main id="main-content">
        {{ $slot }}
    </main>
@else
    <x-public.partials.header/>

    <main id="main-content" class="pt-16 md:pt-20 overflow-visible">
        {{ $slot }}
    </main>

    <livewire:public.partials.footer/>
@endif
</body>
</html>
