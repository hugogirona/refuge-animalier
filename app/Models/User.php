<?php

namespace App\Models;

use App\Enums\UserRoles;
use App\Enums\UserStatus;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;

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

    public function pets(): HasMany
    {
        return $this->hasMany(Pet::class, 'created_by');
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

    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }
    #[Scope]
    public function active(Builder $query): void
    {
        $query->where('status', UserStatus::ACTIVE);
    }


}
