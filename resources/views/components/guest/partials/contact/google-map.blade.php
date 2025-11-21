{{-- components/google-map.blade.php --}}
@props([
    'embedUrl',
    'height' => 'h-80',
])

<div class="bg-white rounded-xl border border-neutral-200 overflow-hidden">
    <div class="{{ $height }} bg-neutral-200 relative">
        <iframe
            src="{{ $embedUrl }}"
            width="100%"
            height="100%"
            style="border:0;"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
            class="w-full h-full"
        ></iframe>
    </div>
</div>
