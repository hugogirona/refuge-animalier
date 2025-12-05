@props([
    'userName' => 'Utilisateur',
    'userRole' => 'Bénévole',
    'userAvatar' => null,
])

<div class="relative" x-data="{ open

: false }" @click.away="open = false">
    {{-- Button --}}
    <button
        @click="open = !open"
        class="flex items-center gap-2 p-2 rounded-lg hover:bg-neutral-100 transition-colors"
    >
        @if($userAvatar)
            <img
                src="{{ $userAvatar }}"
                alt="Avatar de {{ $userName }}"
                class="w-10 h-10 rounded-full object-cover border-2 border-neutral-200"
            >
        @else
            <div class="w-8 h-8 rounded-full bg-primary-500 text-white flex items-center justify-center font-semibold text-sm">
                {{ substr($userName, 0) }}
            </div>
        @endif

        <div class="hidden md:block text-left">
            <p class="text-sm font-semibold text-grayscale-text-title leading-tight">{{ $userName }}</p>
            <p class="text-xs text-grayscale-text-subtitle">{{ $userRole }}</p>
        </div>
        <svg
            class="w-4 h-4 text-grayscale-text-subtitle transition-transform duration-200 fill-none"
            :class="{ 'rotate-180': open }"
            stroke="currentColor"
            viewBox="0 0 24 24"
        >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
    </button>

    {{-- Dropdown Menu --}}
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="absolute overflow-hidden right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-neutral-200"
        style="display: none;"
    >
        <a href="{{ route('settings.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-grayscale-text-subtitle hover:bg-neutral-50 transition-colors">
            <svg class="fill-none w-5 h-5"  stroke="currentColor"  viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 12C14.7614 12 17 9.76142 17 7C17 4.23858 14.7614 2 12 2C9.23858 2 7 4.23858 7 7C7 9.76142 9.23858 12 12 12Z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M20.5901 22C20.5901 18.13 16.7402 15 12.0002 15C7.26015 15 3.41016 18.13 3.41016 22" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Mon profil
        </a>

        <div class="border-t border-neutral-200 "></div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-error-text-link-light hover:bg-error-surface-default-subtle transition-colors">
                <svg class="w-5 h-5 fill-none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                Déconnexion
            </button>
        </form>
    </div>
</div>

