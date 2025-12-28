<?php


use App\Models\User;
use App\Enums\EmailFrequency;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

new class extends Component
{
    public User $user;

    public bool $email_notifications = false;
    public string $email_frequency = '';

    public function mount(): void
    {
        $this->user = Auth::user();

        if (!$this->user->isAdmin()) {
            return;
        }

        $this->email_notifications = $this->user->email_notifications;
        $this->email_frequency = $this->user->email_frequency;
    }

    public function save(): void
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        if ($this->email_notifications === false) {
            $this->email_frequency = EmailFrequency::NEVER->value;
        }

        $this->validate([
            'email_notifications' => 'boolean',
            'email_frequency' => 'required|string|in:' . implode(',', array_column(EmailFrequency::cases(), 'value')),
        ]);

        $this->user->update([
            'email_notifications' => $this->email_notifications,
            'email_frequency' => $this->email_frequency,
        ]);
        session()->flash('success', 'Préférences enregistrées !');
    }
}

?>


<section class="bg-white rounded-xl border border-neutral-200 p-6">
    <h2 class="text-2xl font-bold mb-6">Notifications</h2>

    <form wire:submit="save" novalidate>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-6">

            <fieldset>
                <legend class="block text-sm font-medium text-grayscale-text-subtitle mb-3">
                    Préférences générales
                </legend>

                <x-form.form-checkbox
                    name="email_notifications"
                    value="1"
                    label="Activer les notifications par email"
                    wire:model="email_notifications"
                    :checked="$email_notifications"
                    :error="$errors->first('email_notifications')"
                />
                <p class="text-xs text-neutral-500 mt-2">
                    Si désactivé, vous ne recevrez aucun email du système.
                </p>
            </fieldset>

            <fieldset x-data="{ open: @entangle('email_notifications') }" x-show="open" x-transition>
                <x-form.form-radio
                    label="Fréquence d'envoi"
                    name="email_frequency"
                    layout="vertical"
                    :options="[
                        'immediate' => 'Immédiatement (Dès qu\'un événement survient)',
                        'daily' => 'Résumé quotidien (Chaque matin)',
                        'weekly' => 'Résumé hebdomadaire (Le lundi)',
                    ]"
                    wire:model="email_frequency"
                    required
                    :error="$errors->first('email_frequency')"
                />
            </fieldset>

        </div>

        <div class="flex justify-end gap-4 items-center">
            @if (session()->has('success'))
                <span class="text-sm text-green-600 animate-fade-in font-medium">
                    {{ session('success') }}
                </span>
            @endif

            <x-cta-button role="button"
                          type="submit"
                          size="sm"
                          wire:loading.attr="disabled">
                <span wire:loading.remove>Enregistrer les préférences</span>
                <span wire:loading>Sauvegarde...</span>
            </x-cta-button>
        </div>
    </form>
</section>

