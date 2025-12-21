<?php

namespace App\Providers;

use App\Events\PetUpdated;
use App\Listeners\RefreshPetsList;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{

    protected array $listen = [
        PetUpdated::class => [
            RefreshPetsList::class,
        ],
    ];
    public function register(): void
    {

    }

    public function boot(): void
    {
    }

    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
