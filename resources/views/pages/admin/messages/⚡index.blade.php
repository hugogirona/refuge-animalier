<?php

use App\Enums\ContactMessageStatus;
use App\Models\ContactMessage;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Messages')]
class extends Component {
    public int $messages_count = 0;
    public int $new_messages_count = 0;

    public function mount(): void
    {
        $this->authorize('viewAny', ContactMessage::class);
        $this->messages_count = ContactMessage::count();
        $this->new_messages_count = ContactMessage::where('status', ContactMessageStatus::NEW)->count();
    }

    #[On('message-updated')]
    public function refreshCounts(): void
    {
        $this->new_messages_count = ContactMessage::where('status', ContactMessageStatus::NEW)->count();
        $this->messages_count = ContactMessage::count();
    }
};
?>

<main class="flex-1">
    <x-admin.partials.breadcrumb>
        <x-breadcrumb.breadcrumb-item href="{{ route('dashboard.index') }}">
            Tableau de bord
        </x-breadcrumb.breadcrumb-item>
        <x-breadcrumb.breadcrumb-item current data-last>
            Messages
        </x-breadcrumb.breadcrumb-item>
    </x-admin.partials.breadcrumb>

    <div>
        <x-admin.partials.title-header
            title="Messages reçus"
            subtitle="{{$this->messages_count}} messages au total"
            badgeStatus="{{$this->new_messages_count}} non lus"
            badgeType="secondary"
        />
    </div>

    <div
        x-data="{
        isDesktop: window.innerWidth >= 1500,
        resizeTimer: null,
        init() {
            window.addEventListener('resize', () => {
                clearTimeout(this.resizeTimer)
                this.resizeTimer = setTimeout(() => {
                    this.isDesktop = window.innerWidth >= 1500
                }, 50)
            })
        }
    }"
        class="px-4 md:px-6 max-w-7xl mx-auto"
    >
        <template x-if="!isDesktop">
            <livewire:admin.partials.messages.messages-list/>
        </template>

        <template x-if="isDesktop">
            <livewire:admin.partials.messages.messages-table/>
        </template>
    </div>
</main>
