<?php

namespace App\Models;

use App\Enums\UserRoles;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'role',
        'avatar',
        'status',
        'phone',
        'availability',
        'email_notifications',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'availability' => 'array',
            'email_notifications' => 'boolean',
        ];
    }


    /**
     * Indicate that the user is an admin.
     */
    public function isAdmin(): bool
    {
        return $this->role === UserRoles::ADMIN->value;
    }

    /**
     * Indicate that the user is a volunteer.
     */
    public function isVolunteer(): bool
    {
        return $this->role === UserRoles::VOLUNTEER->value;
    }

}
