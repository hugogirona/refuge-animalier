<?php

use App\Enums\ContactMessageStatus;
use App\Models\Shelter;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe('Contact Page Display (GET)', function () {

    it('displays the contact form', function () {
        Shelter::factory()->create();
        $response = $this->get(route('contact.create'));

        $response->assertOk()
            ->assertViewIs('pages.public.contact.create');
    });

    it('pre-fills subject if present in query string', function () {
        Shelter::factory()->create();
        $response = $this->get(route('contact.create', ['subject' => 'adoption']));

        $response->assertOk()
            ->assertSee('value="adoption"', false);
    });
});

describe('Contact Form Submission (POST)', function () {

    $validated_data = function ($overrides = []) {
        return array_merge([
            'name' => 'Jean Dupont',
            'email' => 'jean@example.com',
            'phone' => '0612345678',
            'subject' => 'Demande de renseignement',
            'content' => 'Bonjour, je voudrais savoir...',
            'rgpd' => '1',
        ], $overrides);
    };

    it('stores the message and redirects with success', function () use ($validated_data) {
        $data = $validated_data();

        $response = $this->post(route('contact.store'), $data);

        // 1. Redirection
        $response->assertRedirect(route('contact.create'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('contact_messages', [
            'name' => 'Jean Dupont',
            'email' => 'jean@example.com',
            'phone' => '0612345678',
            'subject' => 'Demande de renseignement',
            'content' => 'Bonjour, je voudrais savoir...',
            'status' => ContactMessageStatus::NEW->value,
            'replied_by' => null,
        ]);
    });

    it('validates required fields', function () {
        $response = $this->post(route('contact.store'), []);

        $response->assertSessionHasErrors([
            'name', 'email', 'subject', 'content', 'rgpd'
        ]);
    });

    it('validates email format', function () use ($validated_data) {
        $data = $validated_data(['email' => 'not-an-email']);

        $response = $this->post(route('contact.store'), $data);

        $response->assertSessionHasErrors(['email']);
    });

    it('requires rgpd acceptance', function () use ($validated_data) {
        $data = $validated_data();
        unset($data['rgpd']);

        $response = $this->post(route('contact.store'), $data);

        $response->assertSessionHasErrors(['rgpd']);
    });
});
