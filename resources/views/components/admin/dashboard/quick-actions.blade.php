<section>
    <div>
        <h2 class="text-2xl font-bold mb-6">Actions rapides</h2>
        <div class="flex flex-col gap-4 bg-white rounded-xl border border-neutral-200 p-6">
            <x-cta-button class="grow" href="{{ route('admin-pets.index') }}">Vers la gestion des animaux</x-cta-button>
            <x-cta-button class="grow" href="#" icon="plus">Ajouter un animal</x-cta-button>
            <x-cta-button class="grow" variant="secondary" href="{{route('adoptions.index')}}">Voir les demandes d'adoption</x-cta-button>
            <x-cta-button class="grow" variant="outline" href="{{route('users.index')}}">Gérer les bénévoles</x-cta-button>
        </div>
    </div>
</section>
