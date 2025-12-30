<?php

namespace App\Http\Controllers;

use App\Enums\ContactMessageStatus;
use App\Http\Requests\StoreContactMessageRequest;
use App\Models\ContactMessage;
use App\Models\Shelter;

class ContactMessageController extends Controller
{
    public function create()
    {
        $shelter = Shelter::firstOrFail();

        return view('pages.public.contact.create', compact('shelter'));
    }

    public function store(StoreContactMessageRequest $request)
    {
        $validated_data = $request->validated();

        ContactMessage::create([
            ...$validated_data,
            'status' => ContactMessageStatus::NEW,
        ]);

        return redirect()
            ->route('contact.create')
            ->with('success', 'Votre message a bien été envoyé. Nous vous répondrons dans les plus brefs délais.');
    }

}
