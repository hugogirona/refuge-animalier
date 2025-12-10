<?php

namespace App\Enums;

enum PetStatus: string
{
    case AVAILABLE = 'available';
    case IN_CARE = 'in_care';
    case ADOPTED = 'adopted';
    case ADOPTION_PENDING = 'adoption_pending';
}
