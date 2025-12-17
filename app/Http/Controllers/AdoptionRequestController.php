<?php

namespace App\Http\Controllers;

use App\Models\Pet;

class AdoptionRequestController extends Controller
{
    public function create(Pet $pet)
    {
        if (!$pet->isAvailable()) {
            abort(404, 'Cet animal n\'est plus disponible à l\'adoption.');
        }

        return view('pages.public.adoption.create', compact('pet'));
    }
}
