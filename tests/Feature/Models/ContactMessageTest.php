<?php

use App\Enums\ContactMessageStatus;
use App\Models\ContactMessage;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe('ContactMessage Model', function () {

    it('has fillable attributes', function () {
        $msg = ContactMessage::factory()->create([
            'name' => 'Jean',
            'status' => ContactMessageStatus::NEW,
        ]);

        expect($msg)
            ->name->toBe('Jean')
            ->status->toBe(ContactMessageStatus::NEW)
            ->status->toBeInstanceOf(ContactMessageStatus::class);
    });

    it('can filter new messages', function () { //TODO
        ContactMessage::factory()->count(3)->create(['status' => ContactMessageStatus::NEW]);
        ContactMessage::factory()->count(2)->create(['status' => ContactMessageStatus::READ]);

        expect(ContactMessage::query()->new()->count())->toBe(3)
            ->and(ContactMessage::query()->read()->count())->toBe(2);
    });

    it('can filter replied messages', function () { //TODO
        ContactMessage::factory()->replied()->create();
        ContactMessage::factory()->create(['status' => ContactMessageStatus::NEW]);

        expect(ContactMessage::query()->replied()->count())->toBe(1);
    });

    it('can mark message as read', function () {
        $msg = ContactMessage::factory()->create(['status' => ContactMessageStatus::NEW]);

        $msg->markAsRead();

        expect($msg->fresh())
            ->status->toBe(ContactMessageStatus::READ)
            ->read_at->not->toBeNull();
    });

    it('does not change status if already replied when marking as read', function () {

        $msg = ContactMessage::factory()->replied()->create();

        $msg->markAsRead();

        expect($msg->fresh()->status)->toBe(ContactMessageStatus::REPLIED);
    });

    it('can mark message as replied', function () {
        $msg = ContactMessage::factory()->create(['status' => ContactMessageStatus::READ]);
        $user = User::factory()->create();

        $msg->markAsReplied($user);

        expect($msg->fresh())
            ->status->toBe(ContactMessageStatus::REPLIED)
            ->replied_at->not->toBeNull()
            ->replied_by->toBe($user->id);
    });

    it('belongs to a replier', function () {
        $user = User::factory()->create();
        $msg = ContactMessage::factory()->create(['replied_by' => $user->id]);

        expect($msg->replier)->toBeInstanceOf(User::class)
            ->and($msg->replier->id)->toBe($user->id);
    });
});
