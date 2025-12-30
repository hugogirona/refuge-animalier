<x-layout :title="'Réinitialiser le mot de passe'">

    <div class="min-h-screen flex items-center justify-center px-4 py-12 bg-linear-to-br from-primary-surface-default-subtle to-white">
        <div class="w-full max-w-md">
            <x-admin.partials.login.reset-password-card :request="$request"/>
        </div>
    </div>

</x-layout>
