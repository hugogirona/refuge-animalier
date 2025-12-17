@props([
    'label',
    'name',
    'options' => [],
    'required' => false,
    'helper' => '',
    'columns' => 1,
    'value' => [],
    'error' => null,
])

<fieldset>
    <legend class="block text-sm font-medium text-grayscale-text-subtitle mb-3">
        {{ $label }} @if($required)<span class="text-primary-text-link-light">*</span>@endif
    </legend>

    @if($helper)
        <p class="text-sm text-grayscale-text-caption mb-3">{{ $helper }}</p>
    @endif

    <div class="grid grid-cols-{{ $columns }} gap-4">
        @foreach($options as $optionValue => $optionLabel)
            @php
                $uniqueId = $name . '_' . $optionValue . '_' . uniqid();
                // On vérifie si la valeur est dans le tableau old()
                // On utilise in_array strict ou non selon vos besoins (ici non strict pour string/int)
                $isChecked = is_array($value) && in_array($optionValue, $value);
            @endphp

            <label
                for="{{ $uniqueId }}"
                class="flex items-center p-4 border-2 rounded-lg cursor-pointer transition-colors
                {{ $error ? 'border-error-text-link-light' : ($isChecked ? 'border-primary-border-default bg-primary-surface-default-subtle' : 'border-neutral-300 hover:border-primary-border-default') }}"
            >
                <input
                    type="checkbox"
                    id="{{ $uniqueId }}"
                    name="{{ $name }}[]"
                    value="{{ $optionValue }}"
                    @checked($isChecked)
                    class="w-5 h-5 text-primary-500 border-neutral-300 rounded focus:ring-primary-border-default"
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
