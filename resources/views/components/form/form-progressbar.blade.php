@props([
    'form_id' => 'adoptionForm',
])

<div
    class="bg-white border-b border-neutral-200 sticky top-16 md:top-20 z-30"
    x-data="formProgressBar('{{ $form_id }}')"
    x-init="init()"
>
    <div class="container mx-auto px-4 py-4">
        <div class="max-w-3xl mx-auto">
            <div class="flex items-center justify-between mb-2 text-sm">
                <span class="text-neutral-600">Progression</span>
                <span class="text-primary-500 font-semibold" x-text="progress + '%'"></span>
            </div>
            <div class="w-full bg-neutral-200 rounded-full h-2">
                <div
                    class="bg-primary-surface-default h-2 rounded-full transition-all duration-300 ease-out"
                    :style="'width: ' + progress + '%'"
                ></div>
            </div>
        </div>
    </div>
</div>
