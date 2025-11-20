<x-guest.layout title="À Propos">

    <x-breadcrumb.breadcrumb class="!mb-0">
        <x-breadcrumb.breadcrumb-item href="{{ route('home') }}">
            Accueil
        </x-breadcrumb.breadcrumb-item>
        <x-breadcrumb.breadcrumb-item current data-last>
            À propos
        </x-breadcrumb.breadcrumb-item>
    </x-breadcrumb.breadcrumb>

    <x-guest.partials.about.about-banner
        title="Les pattes heureuses"
        subtitle="Notre mission, notre histoire, notre équipe"
        image="about/about-banner"
        image_alt="Chat du refuge Les Pattes Heureuses"
    />

    <div class="max-w-6xl mx-auto">
        <x-text-media
            title="Notre histoire"
            image="home/cat-about"
            image_alt="Petit chat en train de se reposer"
            image_ratio="video"
            :paragraphs="[
        'Tout a commencé en 2018 lorsqu\'Élise, passionnée par les animaux depuis toujours, a décidé de créer un refuge pour venir en aide aux animaux abandonnés et maltraités de la région.',
        'Avec l\'aide de quelques bénévoles dévoués, elle a transformé une ancienne ferme en un havre de paix pour nos amis à quatre pattes.'
    ]"
        />
        <x-text-media
            title="Aujourd’hui"
            image="home/cat-about"
            image_alt="Petit chat en train de se reposer"
            image_order="left"
            image_ratio="video"
            :paragraphs="[
        'Six ans plus tard, Les Pattes Heureuses a accueilli plus de 300 animaux et réalisé 127 adoptions réussies. Notre équipe s\'est agrandie et compte aujourd\'hui 12 bénévoles passionnés.',
        'Chaque animal qui arrive chez nous reçoit tous les soins nécessaires et tout l\'amour qu\'il mérite en attendant de trouver sa famille pour la vie.'
    ]"
        />
    </div>

    <x-guest.partials.about.about-values/>

    <x-guest.partials.about.about-team :team_members="$team_members"/>

</x-guest.layout>

