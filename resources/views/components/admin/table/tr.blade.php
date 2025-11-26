{{-- components/admin/table/tr.blade.php --}}
@props([
    'hoverable' => true,
])

@php
    $classes = 'transition-colors';
    if ($hoverable) {
        $classes .= ' hover:bg-neutral-50';
    }
@endphp

<tr {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</tr>
