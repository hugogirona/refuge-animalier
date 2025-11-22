@props([
    'currentRoute' => null,
])

<aside
    id="sidebar"
    class="fixed md:sticky top-18 sm:top-21 left-0 bottom-0 w-64 bg-white border-r border-neutral-200 z-30 transform -translate-x-full md:translate-x-0 transition-transform duration-300 overflow-y-auto"
    :class="{ 'translate-x-0': menuOpen }"
>
    <nav class="p-4 flex flex-col justify-between h-full">

        <div class="flex flex-col gap-2">
            <h2 class="sr-only">Navigation latérale</h2>

            {{-- Dashboard --}}
            <x-admin.navigation.nav-link
                href="{{ route('dashboard.index') }}"
                icon="dashboard"
                label="Dashboard"
                :active="request()->routeIs('dashboard.index')"
            />

            {{-- Animaux --}}
            <x-admin.navigation.nav-link
                href="{{ route('admin-pets.index') }}"
                icon="paw"
                label="Animaux"
                :active="request()->routeIs('admin-pets.*')"
            />

            {{-- Adoptions --}}
            <x-admin.navigation.nav-link
                href="{{ route('adoptions.index') }}"
                icon="heart"
                label="Adoptions"
                badge="3"
                badgeColor="bg-primary-surface-default"
                :active="request()->routeIs('adoptions.*')"
            />

            {{-- Utilisateurs --}}
            <x-admin.navigation.nav-link
                href="{{ route('users.index') }}"
                icon="people"
                label="Utilisateurs"
                :active="request()->routeIs('users.*')"
            />

            {{-- Messages --}}
            <x-admin.navigation.nav-link
                href="{{ route('messages.index') }}"
                icon="message"
                label="Messages"
                badge="2"
                badgeColor="bg-primary-surface-default"
                :active="request()->routeIs('messages.*')"
            />
        </div>
        {{-- Divider --}}
        <div class="border-t border-neutral-200 mt-4 pt-4">
            {{-- Paramètres --}}
            <x-admin.navigation.nav-link
                href="{{ route('settings.index') }}"
                icon="settings"
                label="Paramètres"
                :active="request()->routeIs('settings.*')"
            />
        </div>
    </nav>
</aside>


{{-- Overlay mobile --}}
<div
    x-show="menuOpen"
    @click="menuOpen = false"
    class="fixed inset-0 z-20 lg:hidden"
    style="display: none;"
></div>
