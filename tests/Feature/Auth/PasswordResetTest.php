<?php

use App\Models\User;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe('Password Reset Flow', function () {

    it('can view the forgot password page', function () {
        $this->get(route('password.request'))
            ->assertOk()
            ->assertSee('Mot de passe oublié');
    });

    it('can request a password reset link', function () {
        Notification::fake();

        $user = User::factory()->create(['email' => 'jean@test.com']);

        $this->post(route('password.email'), ['email' => 'jean@test.com'])
            ->assertSessionHas('status', trans('passwords.sent'));

        Notification::assertSentTo($user, ResetPassword::class);
    });

    it('validates email on forgot password page', function () {
        $this->post(route('password.email'), ['email' => 'not-an-email'])
            ->assertSessionHasErrors('email');
    });

    it('can view the reset password page with token', function () {
        $token = 'fake-token';
        $email = 'jean@test.com';

        $this->get(route('password.reset', ['token' => $token, 'email' => $email]))
            ->assertOk()
            ->assertSee('Nouveau mot de passe')
            ->assertSee($email);
    });

    it('can reset password with valid token', function () {
        $user = User::factory()->create([
            'email' => 'jean@test.com',
            'password' => bcrypt('old-password'),
        ]);

        $token = Password::createToken($user);

        $response = $this->post(route('password.update'), [
            'token' => $token,
            'email' => 'jean@test.com',
            'password' => 'New-Secret-Password-123',
            'password_confirmation' => 'New-Secret-Password-123',
        ]);

        $response->assertRedirect(route('login'))
            ->assertSessionHas('status', trans('passwords.reset'));

        $this->assertTrue(Hash::check('New-Secret-Password-123', $user->fresh()->password));
    });

    it('fails to reset with invalid password confirmation', function () {
        $user = User::factory()->create();
        $token = Password::createToken($user);

        $this->post(route('password.update'), [
            'token' => $token,
            'email' => $user->email,
            'password' => 'New-Password',
            'password_confirmation' => 'Wrong-Confirmation',
        ])->assertSessionHasErrors('password');

        $this->assertTrue(Hash::check('password', $user->fresh()->password));
    });
});
