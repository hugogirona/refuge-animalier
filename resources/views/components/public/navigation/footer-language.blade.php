<div class="flex items-center gap-3">
    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)

        <a rel="alternate" hreflang="{{ $localeCode }}"
           href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
           class="text-sm font-medium uppercase transition-colors
                              {{ $localeCode == App::getLocale()
                                 ? 'text-primary-surface-default font-bold'
                                 : 'text-neutral-400 hover:text-white'
                              }}"
        >
            {{ $localeCode }}
        </a>

        @if(!$loop->last)
            <span class="text-neutral-600">|</span>
        @endif

    @endforeach
</div>
