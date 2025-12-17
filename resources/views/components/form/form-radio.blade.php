@props([
    'label',
    'name',
    'options' => [],
    'required' => false,
    'layout' => 'vertical',
    'helper' => '',
    'value' => null,
    'error' => null,
])

<fieldset>
    <legend class="block text-sm font-medium text-neutral-700 mb-3">
        {{ $label }} @if($required)<span class="text-primary-text-link-light">*</span>@endif
    </legend>

    @if($helper)
        <p class="text-sm text-grayscale-text-caption mb-3">{{ $helper }}</p>
    @endif

    <div class="{{ $layout === 'horizontal' ? 'flex gap-4' : 'space-y-4' }}">
        @foreach($options as $optionValue => $optionLabel)
            @php
                $uniqueId = $name . '_' . $optionValue . '_' . uniqid();
                // On vérifie si cette option correspond à la valeur old()
                $isChecked = (string)$value === (string)$optionValue;
            @endphp

            <label
                for="{{ $uniqueId }}"
                class="flex items-center p-4 border rounded-lg cursor-pointer transition-colors {{ $layout === 'horizontal' ? 'flex-1' : '' }}
                {{-- Style dynamique si coché ou erreur --}}
                {{ $error ? 'border-error-text-link-light' : ($isChecked ? 'border-primary-border-default bg-primary-surface-default-subtle' : 'border-neutral-300 hover:border-primary-border-default') }}"
            >
                <input
                    type="radio"
                    id="{{ $uniqueId }}"
                    name="{{ $name }}"
                    value="{{ $optionValue }}"
                    @if($required) required @endif
                    @checked($isChecked)
                    class="w-5 h-5 text-primary-500 border-neutral-300 focus:ring-primary-border-default"
                >
                <span class="ml-2 text-grayscale-text-subtitle">{{ $optionLabel }}</span>
            </label>
        @endforeach
    </div>

    @if($error)
        <p class="text-error-text-link-light text-sm mt-2">
            {{ $error }}
        </p>
    @endif
</fieldset>
