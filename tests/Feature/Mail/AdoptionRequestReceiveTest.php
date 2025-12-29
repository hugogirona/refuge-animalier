<?php

use App\Mail\AdoptionRequestReceived;
use App\Models\AdoptionRequest;
use App\Models\Pet;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe('AdoptionRequestReceived Mailable', function () {

    it('contains adoption details', function () {

        $pet = Pet::factory()->create(['name' => 'Moka']);
        $request = AdoptionRequest::factory()->create([
            'pet_id' => $pet->id,
            'first_name' => 'Alice',
            'preferred_contact_method' => 'email'
        ]);

        $mailable = new AdoptionRequestReceived($request);


        $mailable->assertSeeInHtml('Bonjour Alice');
        $mailable->assertSeeInHtml('Moka');
        $mailable->assertSeeInHtml('Email');
    });

    it('has the correct subject', function () {
        $request = AdoptionRequest::factory()->create();
        $mailable = new AdoptionRequestReceived($request);

        $mailable->assertHasSubject('Confirmation de votre demande d\'adoption - Les Pattes Heureuses');
    });
});
