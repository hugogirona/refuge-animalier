@props([
    'question',
    'answer',
    'index',
])

<div class="bg-neutral-50 rounded-xl border border-neutral-200 overflow-hidden">
    <button
        x-on:click="openFaq = openFaq === {{ $index }} ? null : {{ $index }}"
        class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-neutral-100 transition-colors"
        type="button"
        x-bind:aria-expanded="openFaq === {{ $index }}"
    >
        <span class="font-semibold text-grayscale-text-body pr-4">{{ $question }}</span>

        <svg
            class="w-5 h-5 text-grayscale-text-subtitle transition-transform duration-300 shrink-0 fill-none"
            x-bind:class="{ 'rotate-180': openFaq === {{ $index }} }"
            stroke="currentColor"
            viewBox="0 0 24 24"
        >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
    </button>

    <div
        x-show="openFaq === {{ $index }}"
        x-collapse
        class="px-6"
    >
        <div class="py-4">
            <p class="text-grayscale-text-subtitle leading-relaxed">
                {{ $answer }}
            </p>
        </div>
    </div>
</div>
