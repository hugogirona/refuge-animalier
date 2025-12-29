<?php

namespace App\Livewire\Admin\Partials\Dashboard;

use App\Enums\AdoptionRequestStatus;
use App\Enums\PetStatus;
use App\Enums\UserRoles;
use App\Enums\UserStatus;
use App\Models\AdoptionRequest;
use App\Models\Pet;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\On;

new class extends Component {
    public int $total_pets = 0;
    public int $pets_trend = 0;

    public int $pending_requests = 0;

    public int $active_volunteers = 0;

    public int $adoptions_this_month = 0;
    public int $adoptions_trend = 0;

    public int $my_created_count = 0;
    public int $my_modified_count = 0;
    public int $my_total_contribution = 0;

    public function getChartAdoptionsProperty(): array
    {
        $driver = DB::getDriverName();

        $dateFormat = $driver === 'sqlite'
            ? "strftime('%Y-%m', updated_at)"
            : "DATE_FORMAT(updated_at, '%Y-%m')";

        $data = AdoptionRequest::where('status', AdoptionRequestStatus::ACCEPTED)
            ->selectRaw("$dateFormat as month, count(*) as total")
            ->groupBy('month')
            ->orderBy('month', 'desc')
            ->limit(6)
            ->get()
            ->reverse();

        return [
            'labels' => $data->pluck('month')->toArray(),
            'values' => $data->pluck('total')->toArray(),
        ];
    }

    public function getChartSpeciesProperty(): array
    {
        $data = Pet::whereIn('status', [
            PetStatus::AVAILABLE,
            PetStatus::IN_CARE,
            PetStatus::ADOPTION_PENDING
        ])
            ->selectRaw('species, count(*) as total')
            ->groupBy('species')
            ->get();

        return [
            'values' => $data->pluck('total')->toArray(),
            'labels' => $data->pluck('species')->map(fn($s) => ucfirst($s->value ?? $s))->toArray(),
        ];
    }

    public function mount(): void
    {
        $this->refreshStats();
    }

    #[On('adoption-updated')]
    #[On('pet-updated')]
    public function refreshStats(): void
    {
        $this->total_pets = Pet::whereIn('status', [PetStatus::AVAILABLE, PetStatus::IN_CARE, PetStatus::ADOPTION_PENDING])->count();

        $this->pets_trend = Pet::where('created_at', '>=', now()->startOfWeek())->count();

        $this->pending_requests = AdoptionRequest::whereIn('status', [
            AdoptionRequestStatus::PENDING,
            AdoptionRequestStatus::NEW
        ])->count();

        $this->active_volunteers = User::where('role', UserRoles::VOLUNTEER)
            ->where('status', UserStatus::ACTIVE)
            ->count();

        $this->adoptions_this_month = AdoptionRequest::where('status', AdoptionRequestStatus::ACCEPTED)
            ->whereMonth('adopted_at', now()->month)
            ->count();

        $last_month_adoptions = AdoptionRequest::where('status', AdoptionRequestStatus::ACCEPTED)
            ->whereMonth('adopted_at', now()->subMonth()->month)
            ->count();

        $this->adoptions_trend = $this->adoptions_this_month - $last_month_adoptions;

        if (auth()->user()->isVolunteer()) {
            $userId = auth()->id();
            $startOfMonth = now()->startOfMonth();

            $this->my_created_count = Pet::where('created_by', $userId)
                ->where('created_at', '>=', $startOfMonth)
                ->count();

            $this->my_modified_count = Pet::where('created_by', $userId)
                ->where('updated_at', '>=', $startOfMonth)
                ->whereColumn('updated_at', '>', 'created_at')
                ->count();

            $this->my_total_contribution = $this->my_created_count + $this->my_modified_count;
        }
    }
}
?>
<section class="my-8 px-5 md:px-6">
    <h2 class="text-2xl font-bold mb-6">Vue d'ensemble</h2>

    <div class="grid grid-cols-2 lg:grid-cols-2 gap-4">

        <x-admin.partials.dashboard.kpi-card
            icon="paw"
            :value="$total_pets"
            label="Animaux au refuge"
            :trend="auth()->user()->isAdmin() && $pets_trend > 0 ? '+' . $pets_trend : null"
            trendLabel="nouveaux cette sem."
        />

        @if(auth()->user()->isVolunteer())
            <x-admin.partials.dashboard.kpi-card
                icon="sheet"
                :value="$my_total_contribution"
                label="Vos contributions ce mois"
                :trendLabel="$my_created_count . ' fiches créées · ' . $my_modified_count . ' fiches modifiées'"
                color="success"
            />
        @endif


        @if(auth()->user()->isAdmin())
            <x-admin.partials.dashboard.kpi-card
                icon="sheet"
                :value="$pending_requests"
                label="Demandes en cours"
            />

            <x-admin.partials.dashboard.kpi-card
                icon="people"
                :value="$active_volunteers"
                label="Bénévoles actifs"
                trendLabel="Total"
            />

            <x-admin.partials.dashboard.kpi-card
                icon="heart"
                :value="$adoptions_this_month"
                label="Adoptions ce mois"
                :trend="$adoptions_trend > 0 ? '+' . $adoptions_trend : ($adoptions_trend < 0 ? $adoptions_trend : null)"
                trendLabel="vs mois dernier"
            />
        @endif
    </div>

    @if(auth()->user()->isAdmin())
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mt-4">

            <x-chart
                type="line"
                title="Évolution des adoptions"
                :labels="$this->chartAdoptions['labels']"
                :data="$this->chartAdoptions['values']"
            />

            <x-chart
                type="doughnut"
                title="Répartition par espèce"
                :labels="$this->chartSpecies['labels']"
                :data="$this->chartSpecies['values']"
                :colors="['#3B82F6', '#F97316',]"
            />

        </div>
    @endif

</section>
