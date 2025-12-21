<?php

namespace App\Listeners;

use App\Events\PetUpdated;
use Illuminate\Support\Facades\Log;

class RefreshPetsList
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PetUpdated $event): void
    {

    }
}
