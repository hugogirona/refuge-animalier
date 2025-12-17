<?php

namespace App\Http\Controllers;

use App\Enums\AdoptionRequestStatus;
use App\Http\Requests\StoreAdoptionRequest;
use App\Models\AdoptionRequest;
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

    public function store(StoreAdoptionRequest $request)
    {
        $validated_data = $request->validated();

        $adoption_request = AdoptionRequest::create([
            ...$validated_data,
            'has_garden' => $validated_data['garden'] === 'yes',
            'status' => AdoptionRequestStatus::NEW,
        ]);

        return redirect()
            ->route('adoption.confirmation', $adoption_request);
    }

    public function confirm(AdoptionRequest $adoption_request)
    {
        $adoption_request->load('pet');

        return view('pages.public.adoption.confirmation', compact('adoption_request'));
    }

}
