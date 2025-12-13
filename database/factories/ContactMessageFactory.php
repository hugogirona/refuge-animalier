<?php

namespace Database\Factories;

use App\Enums\ContactMessageStatus;
use App\Models\ContactMessage;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ContactMessage>
 */
class ContactMessageFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'subject' => fake()->sentence(4),
            'content' => fake()->paragraph(),
            'status' => ContactMessageStatus::NEW,
            'read_at' => null,
            'replied_at' => null,
            'replied_by' => null,
        ];
    }

    public function read(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => ContactMessageStatus::READ,
            'read_at' => now(),
        ]);
    }

    public function replied(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => ContactMessageStatus::REPLIED,
            'read_at' => now()->subHour(),
            'replied_at' => now(),
            'replied_by' => User::factory(),
        ]);
    }
}
