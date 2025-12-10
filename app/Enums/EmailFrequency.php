<?php

namespace App\Enums;

enum EmailFrequency: string
{
    case IMMEDIATE = 'immediate';
    case DAILY = 'daily';
    case WEEKLY = 'weekly';
    case NEVER = 'never';
}
