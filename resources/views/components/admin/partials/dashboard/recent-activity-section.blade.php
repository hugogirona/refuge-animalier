<?php

namespace App\Livewire\Admin\Partials\Dashboard;

use App\Models\AdoptionRequest;
use App\Models\ContactMessage;
use App\Models\Pet;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Livewire\Component;

new class extends Component {
    public Collection $activities;

    public function mount(): void
    {
        $this->loadActivities();
    }

    public function loadActivities(): void
    {
        $user = auth()->user();
        $list = collect();

        $petQuery = Pet::with(['creator', 'publisher'])->latest();

        if ($user->isVolunteer()) {
            $petQuery->where('created_by', $user->id);
        }

        $pets = $petQuery->take(5)->get();

        foreach ($pets as $pet) {
            $isMe = $pet->created_by === $user->id;
            $list->push([
                'timestamp' => $pet->created_at,
                'user' => $isMe ? 'Vous' : $pet->creator->full_name,
                'action' => $isMe ? 'avez créé la fiche de' : 'a créé la fiche de',
                'target' => $pet->name,
                'time' => $pet->created_at->diffForHumans(),
                'link' => route('admin-pets.show', $pet),
            ]);

            if ($pet->is_published && $pet->published_at) {
                $isPublisherMe = $pet->published_by === $user->id;

                if ($user->isAdmin() || (!$isPublisherMe && $pet->created_by === $user->id)) {
                    $publisherName = $pet->publisher->full_name ?? 'Un administrateur';
                    $list->push([
                        'timestamp' => $pet->published_at,
                        'user' => $isPublisherMe ? 'Vous' : $publisherName,
                        'action' => $isPublisherMe ? 'avez publié la fiche de' : 'a publié votre fiche',
                        'target' => $pet->name,
                        'time' => $pet->published_at->diffForHumans(),
                        'link' => route('admin-pets.show', $pet),
                    ]);
                }
            }
        }

        if ($user->isAdmin()) {

            $adoptions = AdoptionRequest::with('pet')->latest()->take(5)->get();
            foreach ($adoptions as $adoption) {
                $list->push([
                    'timestamp' => $adoption->created_at,
                    'user' => $adoption->full_name,
                    'action' => 'a envoyé une demande pour',
                    'target' => $adoption->pet->name,
                    'time' => $adoption->created_at->diffForHumans(),
                    'link' => route('adoptions.show', $adoption),
                ]);
            }

            $messages = ContactMessage::latest()->take(5)->get();
            foreach ($messages as $message) {
                $list->push([
                    'timestamp' => $message->created_at,
                    'user' => $message->name,
                    'action' => 'a envoyé un message :',
                    'target' => Str::limit($message->subject, 20),
                    'time' => $message->created_at->diffForHumans(),
                    'link' => route('messages.show', $message),
                ]);
            }
        }

        $this->activities = $list->sortByDesc('timestamp')->take(6);
    }
}
?>

<section>
    <h2 class="text-2xl font-bold text-neutral-900 mb-6">Activités récentes</h2>

    <div class="divide-y divide-neutral-100 bg-white rounded-xl border border-neutral-200 p-6">
        @forelse($activities as $activity)
            <x-admin.partials.dashboard.activity-item
                :user="$activity['user']"
                :action="$activity['action']"
                :target="$activity['target']"
                :time="$activity['time']"
                :link="$activity['link'] ?? null"
            />
        @empty
            <div class="py-8 text-center">
                <p class="text-sm text-neutral-500">Aucune activité récente.</p>
            </div>
        @endforelse
    </div>
</section>

