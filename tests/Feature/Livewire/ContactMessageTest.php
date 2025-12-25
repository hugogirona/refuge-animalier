<?php

use App\Enums\ContactMessageStatus;
use App\Models\ContactMessage;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe('Messages Table Component', function () {

    $componentName = 'admin.partials.messages.messages-table';

    it('renders the list with messages', function () use ($componentName) {
        ContactMessage::factory()->create(['name' => 'Alice']);
        ContactMessage::factory()->create(['name' => 'Bob']);

        Livewire::test($componentName)
            ->assertOk()
            ->assertSee('Alice')
            ->assertSee('Bob');
    });

    it('can search messages', function () use ($componentName) {
        ContactMessage::factory()->create(['subject' => 'Urgent Question']);
        ContactMessage::factory()->create(['subject' => 'Just saying hi']);

        Livewire::test($componentName)
            ->set('search', 'Urgent')
            ->assertSee('Urgent Question')
            ->assertDontSee('Just saying hi');
    });

    it('can delete selected messages and dispatches update', function () use ($componentName) {
        $msg = ContactMessage::factory()->create();

        Livewire::test($componentName)
            ->set('selected', [$msg->id])
            ->call('deleteSelected')
            ->assertDispatched('message-updated');

        $this->assertDatabaseMissing('contact_messages', ['id' => $msg->id]);
    });

    it('can mark selected messages as read and dispatches update', function () use ($componentName) {
        $msg = ContactMessage::factory()->create(['status' => ContactMessageStatus::NEW]);

        Livewire::test($componentName)
            ->set('selected', [$msg->id])
            ->call('markAsReadSelected')
            ->assertDispatched('message-updated');

        expect($msg->refresh()->status)->toBe(ContactMessageStatus::READ);
    });
});
