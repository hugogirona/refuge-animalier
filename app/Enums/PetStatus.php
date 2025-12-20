<?php

namespace App\Enums;

enum PetStatus: string
{
    case AVAILABLE = 'available';
    case IN_CARE = 'in_care';
    case ADOPTED = 'adopted';
    case ADOPTION_PENDING = 'adoption_pending';

    public function color(): string
    {
        return match($this) {
            self::AVAILABLE => 'success',
            self::IN_CARE => 'warning',
            self::ADOPTED => 'default',
            self::ADOPTION_PENDING => 'secondary',
        };
    }
}


