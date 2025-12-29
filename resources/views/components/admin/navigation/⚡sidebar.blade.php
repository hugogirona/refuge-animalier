<?php
use App\Enums\AdoptionRequestStatus;
use App\Enums\ContactMessageStatus;
use App\Models\AdoptionRequest;
use App\Models\ContactMessage;
use Livewire\Component;
use Livewire\Attributes\On;

new class extends Component
{
    public int $adoptions_count = 0;
    public int $messages_count = 0;

    public function mount(): void
    {
        $this->refreshCounts();
    }

    #[On('adoption-updated')]
    #[On('message-updated')]
    public function refreshCounts(): void
    {
        $this->adoptions_count = AdoptionRequest::where('status', AdoptionRequestStatus::NEW)->count();
        $this->messages_count = ContactMessage::where('status', ContactMessageStatus::NEW)->count();
    }

}
?>

<aside
    id="sidebar"
    class="fixed md:sticky top-18 sm:top-21 left-0 bottom-0 w-64 bg-white border-r border-neutral-200 z-30 transform -translate-x-full md:translate-x-0 transition-transform duration-300 overflow-y-auto"
    :class="{ 'translate-x-0': menuOpen }"
>
    <nav class="p-4 flex flex-col justify-between h-full" aria-label="Navigation latérale">

        <ul class="flex flex-col gap-2">

            <li>
                <x-admin.navigation.nav-link
                    href="{{ route('dashboard.index') }}"
                    icon="dashboard"
                    label="Dashboard"
                    :active="request()->routeIs('dashboard.index')"
                />
            </li>
            <li>
                <x-admin.navigation.nav-link
                    href="{{ route('admin-pets.index') }}"
                    icon="paw"
                    label="Animaux"
                    :active="request()->routeIs('admin-pets.*')"
                />
            </li>
            @if(auth()->user()->isAdmin())
            <li>
                <x-admin.navigation.nav-link
                    href="{{ route('adoptions.index') }}"
                    icon="heart"
                    label="Adoptions"
                    :badge="$adoptions_count > 0 ? $adoptions_count : null"
                    badgeColor="bg-primary-surface-default"
                    :active="request()->routeIs('adoptions.*')"
                />
            </li>
            <li>
                <x-admin.navigation.nav-link
                    href="{{ route('users.index') }}"
                    icon="people"
                    label="Utilisateurs"
                    :active="request()->routeIs('users.*')"
                />
            </li>
            <li>
                <x-admin.navigation.nav-link
                    href="{{ route('messages.index') }}"
                    icon="message"
                    label="Messages"
                    :badge="$messages_count > 0 ? $messages_count : null"
                    badgeColor="bg-primary-surface-default"
                    :active="request()->routeIs('messages.*')"
                />
            </li>
            @endif


            <li class="border-t border-neutral-200 my-4 py-4">
                {{-- Paramètres --}}
                <x-admin.navigation.nav-link
                    href="{{ route('settings.index') }}"
                    icon="settings"
                    label="Paramètres"
                    :active="request()->routeIs('settings.*')"
                />
            </li>

        </ul>

    </nav>
</aside>

