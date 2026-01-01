@if ($paginator->hasPages())
    <div class="flex flex-col items-center gap-3">

        <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center gap-2">

            @if ($paginator->onFirstPage())
                <span class="flex items-center justify-center w-10 h-10 rounded-lg border border-neutral-200 bg-white text-grayscale-text-caption cursor-not-allowed" aria-hidden="true">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="{{ __('pagination.previous') }}" class="flex items-center justify-center w-10 h-10 rounded-lg border border-neutral-200 bg-white text-grayscale-text-subtitle hover:border-primary-border-default hover:text-primary-text-link-light transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </a>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="flex items-center justify-center w-10 h-10 text-grayscale-text-caption font-medium">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span aria-current="page">
                                <span class="flex items-center justify-center w-10 h-10 rounded-lg border border-b-primary-border-default-light bg-primary-surface-default-light text-white font-bold shadow-sm">
                                    {{ $page }}
                                </span>
                            </span>
                        @else
                            <a href="{{ $url }}" aria-label="{{ __('Go to page :page', ['page' => $page]) }}" class="flex items-center justify-center w-10 h-10 rounded-lg border border-neutral-200 bg-white text-grayscale-text-subtitle font-medium hover:bg-primary-surface-default-subtle hover:border-primary-border-default hover:text-primary-text-link-light transition-colors">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="{{ __('pagination.next') }}" class="flex items-center justify-center w-10 h-10 rounded-lg border border-neutral-200 bg-white text-grayscale-text-subtitle hover:border-primary-border-default hover:text-primary-text-link-light transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
            @else
                <span class="flex items-center justify-center w-10 h-10 rounded-lg border border-neutral-200 bg-white text-grayscale-text-caption cursor-not-allowed" aria-hidden="true">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </span>
            @endif
        </nav>

        <div class="text-sm font-medium text-grayscale-text-subtitle">
            Page <span class="text-grayscale-text-body font-semibold">{{ $paginator->currentPage() }}</span> sur <span class="text-grayscale-text-body font-semibold">{{ $paginator->lastPage() }}</span>
            <span class="mx-1">·</span>
            <span class="text-grayscale-text-body font-semibold">{{ $paginator->total() }}</span> {{ $itemName ?? 'animaux' }} au total
        </div>

    </div>
@endif
