@props([
    'number',
    'title',
])

<fieldset class="form-section bg-white rounded-xl border border-neutral-200 p-6 mb-6">
    <div class="flex items-center gap-3 mb-6">
        <div class="w-10 h-10 bg-primary-surface-default-light text-white rounded-full flex items-center justify-center font-bold">
            {{ $number }}
        </div>
        <legend class="text-2xl font-semibold">{{ $title }}</legend>
    </div>

    <div class="space-y-4">
        {{ $slot }}
    </div>
</fieldset>
