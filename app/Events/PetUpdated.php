<?php

namespace App\Events;

use App\Models\Pet;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PetUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Pet $pet;
    public array $changes;

    public function __construct(Pet $pet, array $changes = [])
    {
        $this->pet = $pet;
        $this->changes = $changes;
    }
}
