{{-- components/form-radio.blade.php --}}
@props([
    'label',
    'name',
    'options' => [],
    'required' => false,
    'layout' => 'vertical',
    'helper' => '',
])

<fieldset>

    <legend class="block text-sm font-medium text-neutral-700 mb-3">
        {{ $label }} @if($required)<span class="text-primary-text-link-light">*</span>@endif
    </legend>

    {{-- Helper text --}}
    @if($helper)
        <p class="text-sm text-grayscale-text-caption mb-3">{{ $helper }}</p>
    @endif

    {{-- Radio buttons --}}
    <div class="{{ $layout === 'horizontal' ? 'flex gap-4' : 'space-y-4' }}">
        @foreach($options as $value => $optionLabel)
            @php
                // Générer un ID unique pour chaque radio
                $uniqueId = $name . '_' . $value . '_' . uniqid();
            @endphp

            <label
                for="{{ $uniqueId }}"
                class="flex items-center p-4 border-2 border-neutral-300 rounded-lg cursor-pointer hover:border-primary-border-default transition-colors {{ $layout === 'horizontal' ? 'flex-1' : '' }}"
            >
                <input
                    type="radio"
                    id="{{ $uniqueId }}"
                    name="{{ $name }}"
                    value="{{ $value }}"
                    @if($required) required @endif
                    class="w-5 h-5 text-primary-500 border-neutral-300 focus:ring-primary-border-default"
                >
                <span class="ml-2 text-grayscale-text-subtitle">{{ $optionLabel }}</span>
            </label>
        @endforeach
    </div>

    {{-- Message d'erreur --}}
    @if($required)
        <p class="text-error-text-link-light text-sm mt-2 hidden error-message" data-error="{{ $name }}">
            Veuillez sélectionner une option
        </p>
    @endif
</fieldset>
