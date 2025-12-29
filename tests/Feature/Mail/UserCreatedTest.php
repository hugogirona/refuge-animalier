<?php

use App\Mail\UserCreated;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe('UserCreated Mailable', function () {

    it('contains the correct content', function () {

        $user = User::factory()->create([
            'first_name' => 'Jean',
            'email' => 'jean@test.com'
        ]);
        $tempPassword = 'SecretPassword123';


        $mailable = new UserCreated($user, $tempPassword);


        $mailable->assertSeeInHtml('Jean');
        $mailable->assertSeeInHtml('SecretPassword123');
        $mailable->assertSeeInHtml(route('login'));
        $mailable->assertSeeInHtml('jean@test.com');
    });

    it('has the correct subject', function () {
        $user = User::factory()->create();
        $mailable = new UserCreated($user, 'pass');

        $mailable->assertHasSubject('Bienvenue chez Les Pattes Heureuses !');
    });
});
