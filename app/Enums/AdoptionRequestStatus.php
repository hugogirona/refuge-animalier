<?php

namespace App\Enums;

enum AdoptionRequestStatus: string
{
    case PENDING = 'pending';
    case ACCEPTED = 'accepted';
    case REJECTED = 'rejected';

    case NEW = 'new';
}
