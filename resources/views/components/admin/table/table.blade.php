@props([
    'striped' => false,
    'hoverable' => true,
])

<div class=" bg-white rounded-xl border border-neutral-200">
    <table {{ $attributes->merge(['class' => 'w-full']) }}>
        {{ $slot }}
    </table>
</div>
