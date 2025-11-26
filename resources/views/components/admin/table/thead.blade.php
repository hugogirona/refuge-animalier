{{-- components/admin/table/thead.blade.php --}}
@props([])

<thead {{ $attributes->merge(['class' => 'bg-neutral-50 border-b border-neutral-200']) }}>
{{ $slot }}
</thead>
