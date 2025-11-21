@props([
    'question',
    'answer',
    'index',
])

<div class="faq-item bg-neutral-50 rounded-xl border border-neutral-200 overflow-hidden">
    <button
        @click="openFaq = openFaq === {{ $index }} ? null : {{ $index }}"
        class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-neutral-100 transition-colors"
        type="button"
    >
        <span class="font-semibold text-grayscale-text-body pr-4">{{ $question }}</span>
        <svg
            class="faq-icon w-5 h-5 fill-none text-grayscale-text-subtitle transition-transform duration-300 flex-shrink-0"
            :class="{ 'rotate-180': openFaq === {{ $index }} }"
            stroke="currentColor"
            viewBox="0 0 24 24"
        >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
    </button>

    <div
        class="faq-content px-6 py-4"
        x-show="openFaq === {{ $index }}"
        x-collapse
    >
        <p class="text-grayscale-text-subtitle leading-relaxed">
            {{ $answer }}
        </p>
    </div>
</div>
