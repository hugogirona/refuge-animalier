<?php

namespace App\Models;

use App\Concerns\HandleImages; // <-- AJOUT DU TRAIT
use App\Enums\UserRoles;
use App\Enums\UserStatus;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HandleImages; // <-- AJOUT DU TRAIT

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
        // Pour les avatars, on n'a peut-être pas de variant "original" public,
        // on utilise souvent le medium comme photo principale.
        // Si vous avez défini une taille 'original' ou 'large', utilisez-la.
        return $this->getVariantUrl('medium');
    }

    /**
     * Helper: Construit l'URL en fonction de la config 'avatars'
     */
    protected function getVariantUrl(string $variantName): ?string
    {
        // 1. Si pas d'avatar, placeholder direct
        if (!$this->avatar) {
            return $this->getPlaceholderUrl();
        }

        // 2. Récupération des infos
        $fileNameWithoutExt = pathinfo($this->avatar, PATHINFO_FILENAME);
        $extension = config('avatars.image_type', 'webp'); // Config 'avatars'

        // 3. Construction du chemin : images/avatars/thumbnail/nom.webp
        $variantPath = sprintf(config('avatars.path_to_variant'), $variantName);
        $fullPath = $variantPath . '/' . $fileNameWithoutExt . '.' . $extension;

        // 4. Vérification d'existence
        if (Storage::disk('public')->exists($fullPath)) {
            return asset('storage/' . $fullPath);
        }

        // 5. Fallback
        return $this->getPlaceholderUrl();
    }

    protected function getPlaceholderUrl(): string
    {
        $fullName = $this->first_name . ' ' . $this->last_name;
        return 'https://ui-avatars.com/api/?name=' . urlencode($fullName) . '&size=600&background=f97316&color=fff';
    }
}
