{{-- components/form-checkbox-group.blade.php --}}
@props([
    'label',
    'name',
    'options' => [],
    'required' => false,
    'helper' => '',
    'columns' => 1,
])

<fieldset>
    {{-- Legend (titre sémantique du groupe) --}}
    <legend class="block text-sm font-medium text-grayscale-text-subtitle mb-3">
        {{ $label }} @if($required)<span class="text-primary-text-link-light">*</span>@endif
    </legend>

    {{-- Helper text --}}
    @if($helper)
        <p class="text-sm text-grayscale-text-caption mb-3">{{ $helper }}</p>
    @endif

    {{-- Grid de checkboxes --}}
    <div class="grid grid-cols-{{ $columns }} gap-4">
        @foreach($options as $value => $optionLabel)
            @php
                // Générer un ID unique pour chaque checkbox
                $uniqueId = $name . '_' . $value . '_' . uniqid();
            @endphp

            <label
                for="{{ $uniqueId }}"
                class="flex items-center p-4 border-2 border-neutral-300 rounded-lg cursor-pointer hover:border-primary-border-default transition-colors"
            >
                <input
                    type="checkbox"
                    id="{{ $uniqueId }}"
                    name="{{ $name }}[]"
                    value="{{ $value }}"
                    @if($required && $loop->first) required @endif
                    class="w-5 h-5 text-primary-500 border-neutral-300 rounded focus:ring-primary-border-default"
                >
                <span class="ml-2 text-grayscale-text-subtitle">{{ $optionLabel }}</span>
            </label>
        @endforeach
    </div>

    {{-- Message d'erreur --}}
    @if($required)
        <p class="text-error-text-link-light text-sm mt-2 hidden error-message" data-error="{{ $name }}">
            Veuillez sélectionner au moins une option
        </p>
    @endif
</fieldset>
