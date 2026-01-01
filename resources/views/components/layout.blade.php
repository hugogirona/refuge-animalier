@props([
    'title' => null,
    'description' => null,
    'type' => 'base'
])

@php
    $siteName = __('head.site_name');
    $pageTitle = $title ? "$title | $siteName" : $siteName;
    $pageDescription = $description ?? __('head.description');
    $currentUrl = url()->current();
@endphp

    <!doctype html>
<html lang="{{ App::getLocale() }}" class="h-full scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ $pageTitle }}</title>
    <meta name="description" content="{{ $pageDescription }}">
    <meta name="keywords" content="{{ __('head.keywords') }}">
    <meta name="author" content="{{ $siteName }}">
    <link rel="canonical" href="{{ $currentUrl }}" />

    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ $currentUrl }}" />
    <meta property="og:title" content="{{ $pageTitle }}" />
    <meta property="og:description" content="{{ $pageDescription }}" />
    <meta property="og:site_name" content="{{ $siteName }}" />
    <meta property="og:locale" content="{{ App::getLocale() }}" />

    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:url" content="{{ $currentUrl }}" />
    <meta name="twitter:title" content="{{ $pageTitle }}" />
    <meta name="twitter:description" content="{{ $pageDescription }}" />

    <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
    <meta name="apple-mobile-web-app-title" content="Les Pattes Heureuses" />
    <link rel="manifest" href="/site.webmanifest" />

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    {{ $head ?? '' }}
</head>
<body class="bg-white overflow-visible min-w-[360px]" x-data="{ menuOpen: false }"
      x-effect="document.body.style.overflow = menuOpen ? 'hidden' : ''">

{{-- Lien d'évitement --}}
<a href="#main-content"
   class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-1/2 focus:-translate-x-1/2 focus:z-50 focus:px-4 focus:py-2 focus:bg-white focus:text-primary-surface-default-light focus:font-bold focus:shadow-lg focus:rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-surface-default transition-transform">
    {{ __('link-title.main-content') }}
</a>

@if(request()->routeIs('login') || request()->routeIs('password.request') )
    <main id="main-content">
        {{ $slot }}
    </main>
@else
    <x-public.partials.header/>

    <main id="main-content" class="pt-16 md:pt-20 overflow-visible outline-none" tabindex="-1">
        {{ $slot }}
    </main>

    <livewire:public.partials.footer/>
@endif
</body>
</html>
