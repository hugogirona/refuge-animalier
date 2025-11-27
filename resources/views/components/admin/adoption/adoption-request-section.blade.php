<section class="bg-white rounded-lg border border-neutral-200 p-6">
    <h2 class="text-xl font-bold mb-6">Demandes d'adoption</h2>

    <div class="space-y-4">
        <x-admin.adoption.adoption-request-card
            name="Sarah Martin"
            email="sarah.martin@email.com"
            status="new"
            :isNew="true"
            :href="route('adoptions.show')"
        />

        <x-admin.adoption.adoption-request-card
            name="Marc Leroy"
            email="marc.leroy@email.com"
            status="pending"
            :href="route('adoptions.show')"
        />

        <x-admin.adoption.adoption-request-card
            name="Julie Dupont"
            email="julie.dupont@email.com"
            status="approved"
            :href="route('adoptions.show')"
        />
    </div>
</section>

