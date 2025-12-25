<?php

use App\Enums\ContactMessageStatus;
use App\Models\ContactMessage;
use Livewire\Component;

new class extends Component
{
    public ContactMessage $message;

    public function mount(ContactMessage $message): void
    {
        $this->message = $message;


        if ($this->message->status === ContactMessageStatus::NEW) {
            $this->message->markAsRead();
            $this->dispatch('message-updated');
        }
    }

}

?>



<main class="flex-1">
    {{-- Breadcrumb --}}
    <x-admin.partials.breadcrumb>
        <x-breadcrumb.breadcrumb-item href="{{ route('dashboard.index') }}">Tableau de bord</x-breadcrumb.breadcrumb-item>
        <x-breadcrumb.breadcrumb-item href="{{ route('messages.index') }}">Messages</x-breadcrumb.breadcrumb-item>
        <x-breadcrumb.breadcrumb-item current data-last>Détail du message</x-breadcrumb.breadcrumb-item>
    </x-admin.partials.breadcrumb>

    {{-- Header --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center px-5 md:px-6 gap-4 mb-8 max-w-7xl mx-auto">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold mb-2">{{ $message->subject }}</h1>
            <div class="flex items-center gap-3">
                <x-admin.status-badge
                    :status="$message->status->value"
                    :type="$message->status === ContactMessageStatus::NEW ? 'primary' : 'default'"
                />
                <span class="text-sm text-grayscale-text-subtitle">Reçu le {{ $message->created_at->format('d/m/Y à H:i') }}</span>
            </div>
        </div>

        <div class="flex gap-3">
            <x-cta-button
                href="mailto:{{ $message->email }}?subject=Re: {{ $message->subject }}"
                variant="primary"
                icon="email"
            >
                Répondre
            </x-cta-button>

        </div>
    </div>

    <div class="max-w-7xl mx-auto px-5 md:px-6">
        <div class="bg-white rounded-xl border border-neutral-200 p-6 md:p-8">
            <div class="flex items-center gap-4 mb-6 pb-6 border-b border-neutral-100">
                <div class="w-12 h-12 rounded-full bg-primary-100 text-primary-700 flex items-center justify-center font-bold text-lg">
                    {{ substr($message->name, 0, 1) }}
                </div>
                <div>
                    <h2 class="text-lg font-bold text-grayscale-text-title">{{ $message->name }}</h2>
                    <a href="mailto:{{ $message->email }}" class="text-primary-text-link-light hover:underline">{{ $message->email }}</a>
                    @if($message->phone)
                        <span class="text-neutral-400 mx-2">•</span>
                        <a href="tel:{{ $message->phone }}" class="text-grayscale-text-subtitle hover:text-grayscale-text-body">{{ $message->phone }}</a>
                    @endif
                </div>
            </div>

            <div class="prose max-w-none text-grayscale-text-body whitespace-pre-line leading-relaxed">
                {{ $message->content }}
            </div>
        </div>
    </div>
</main>
