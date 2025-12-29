<?php

use App\Models\AdoptionRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe('Adoption Request Policy', function () {

    it('allows admin to approve adoptions', function () {
        $admin = User::factory()->admin()->create();
        $adoption = AdoptionRequest::factory()->create();

        expect($admin->can('approve', $adoption))->toBeTrue();
    });

    it('denies volunteer from approving adoptions', function () {
        $volunteer = User::factory()->volunteer()->create();
        $adoption = AdoptionRequest::factory()->create();

        expect($volunteer->cannot('approve', $adoption))->toBeTrue();
    });

    it('allows only admin to view adoptions', function () {
        $admin = User::factory()->admin()->create();
        $volunteer = User::factory()->volunteer()->create();

        expect($admin->can('viewAny', AdoptionRequest::class))->toBeTrue()
            ->and($volunteer->cant('viewAny', AdoptionRequest::class))->toBeTrue();
    });
});
