<?php

namespace App\Models;

use App\Concerns\HandleImages;
use App\Enums\UserRoles;
use App\Enums\UserStatus;
use App\Policies\UserPolicy;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

#[UsePolicy(UserPolicy::class)]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HandleImages;

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
        'email_frequency',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'availability' => 'array',
            'email_notifications' => 'boolean',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships & Helpers
    |--------------------------------------------------------------------------
    */

    public function pets(): HasMany
    {
        return $this->hasMany(Pet::class, 'created_by');
    }

    public function isAdmin(): bool
    {
        return $this->role === UserRoles::ADMIN->value;
    }

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

    /*
    |--------------------------------------------------------------------------
    | Image Accessors (Adaptés pour 'avatar')
    |--------------------------------------------------------------------------
    */

    /**
     * Get thumbnail URL (100x100)
     */
    public function getThumbnailUrlAttribute(): ?string
    {
        return $this->getVariantUrl('thumbnail');
    }

    /**
     * Get medium size URL (300x300)
     */
    public function getMediumUrlAttribute(): ?string
    {
        return $this->getVariantUrl('medium');
    }

    /**
     * Get large size URL (Full)
     */
    public function getLargeUrlAttribute(): ?string
    {
        return $this->getVariantUrl('large');
    }

    /**
     * Get original URL (WebP optimized)
     */
    public function getPhotoUrlAttribute(): ?string
    {
        return $this->getVariantUrl('medium');
    }

    /**
     * Helper: Construit l'URL en fonction de la config 'avatars'
     */
    protected function getVariantUrl(string $variantName): ?string
    {
        if (!$this->avatar) {
            return $this->getPlaceholderUrl();
        }

        $fileNameWithoutExt = pathinfo($this->avatar, PATHINFO_FILENAME);
        $extension = config('avatars.image_type', 'webp');

        $variantPath = sprintf(config('avatars.path_to_variant'), $variantName);
        $fullPath = $variantPath . '/' . $fileNameWithoutExt . '.' . $extension;

        $diskName = config('avatars.variant_disk');

        if (Storage::disk($diskName)->exists($fullPath)) {
            return Storage::disk($diskName)->url($fullPath);
        }

        return $this->getPlaceholderUrl();
    }


    protected function getPlaceholderUrl(): string
    {
        $fullName = $this->first_name . ' ' . $this->last_name;
        return 'https://ui-avatars.com/api/?name=' . urlencode($fullName) . '&size=600&background=f97316&color=fff';
    }
}
