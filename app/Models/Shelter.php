<?php

namespace App\Models;

use Database\Factories\ShelterFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shelter extends Model
{
    /** @use HasFactory<ShelterFactory> */
    use HasFactory;

    protected $fillable = [
        'name', 'address', 'zip_code', 'city', 'phone', 'email',
    ];
}
