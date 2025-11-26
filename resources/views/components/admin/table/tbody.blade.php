@props([])

<tbody {{ $attributes->merge(['class' => 'bg-white divide-y divide-neutral-200']) }}>
{{ $slot }}
</tbody>
