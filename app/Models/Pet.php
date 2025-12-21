<?php

namespace App\Models;

use App\Enums\AdoptionRequestStatus;
use App\Enums\PetBreeds;
use App\Enums\PetSex;
use App\Enums\PetSpecies;
use App\Enums\PetStatus;
use Database\Factories\PetFactory;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Pet extends Model
{
    /** @use HasFactory<PetFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'species',
        'breed',
        'sex',
        'coat_color',
        'birth_date',
        'last_vet_visit',
        'vaccinations',
        'sterilized',
        'personality',
        'story',
        'status',
        'photo_path',
        'slug',
        'is_published',
        'created_by',
        'published_by',
        'published_at',
        'arrived_at',
    ];

    protected function casts(): array
    {
        return [
            'species' => PetSpecies::class,
            'sex' => PetSex::class,
            'status' => PetStatus::class,
            'is_published' => 'boolean',
            'published_at' => 'datetime',
            'arrived_at' => 'date',
            'birth_date' => 'date',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * Get the user who created the pet.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the user who published the pet.
     */
    public function publisher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'published_by');
    }

    public function breed(): BelongsTo
    {
        return $this->belongsTo(Breed::class);
    }

    /**
     * Get all internal notes for the pet.
     */
    public function internalNotes(): MorphMany
    {
        return $this->morphMany(InternalNote::class, 'notable')->latest();
    }

    /**
     * Get the adoption requests for the pet.
     */
    public function adoptionRequests(): HasMany
    {
        return $this->hasMany(AdoptionRequest::class);
    }

    public function acceptedRequest(): HasOne
    {
        return $this->hasOne(AdoptionRequest::class)
            ->where('status', AdoptionRequestStatus::ACCEPTED);
    }


    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    /**
     * Scope to get only published pets.
     */
    #[Scope]
    public function published($query)
    {
        return $query->where('is_published', true);
    }

    /**
     * Scope to get available pets.
     */
    #[Scope]
    public function available($query)
    {
        return $query->where('status', PetStatus::AVAILABLE)
            ->where('is_published', true);
    }

    /**
     * Scope to filter by species.
     */
    #[Scope]
    public function ofSpecies($query, PetSpecies $species)
    {
        return $query->where('species', $species);
    }

    /**
     * Scope to filter by status.
     */
    #[Scope]
    public function withStatus($query, PetStatus $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope to get pets created by a specific user.
     */
    #[Scope]
    public function createdBy($query, User $user)
    {
        return $query->where('created_by', $user->id);
    }

    /*
    |--------------------------------------------------------------------------
    | Helper Methods
    |--------------------------------------------------------------------------
    */

    /**
     * Check if pet is available for adoption.
     */
    public function isAvailable(): bool
    {
        return $this->status === PetStatus::AVAILABLE && $this->is_published;
    }

    /**
     * Check if pet is published.
     */
    public function isPublished(): bool
    {
        return $this->is_published;
    }

    /**
     * Publish the pet.
     */
    public function publish(User $user): void
    {
        $this->update([
            'is_published' => true,
            'published_by' => $user->id,
            'published_at' => now(),
        ]);
    }

    /**
     * Unpublish the pet.
     */
    public function unpublish(): void
    {
        $this->update([
            'is_published' => false,
        ]);
    }

    /**
     * Add an internal note to the pet.
     */
    public function addInternalNote(string $content, User $user): InternalNote
    {
        return $this->internalNotes()->create([
            'content' => $content,
            'user_id' => $user->id,
        ]);
    }

    /**
     * Get the pet's age in years.
     */
    public function getAgeAttribute(): ?int
    {
        return $this->birth_date?->diffInYears(now());
    }

    /**
     * Get the pet's age as a human-readable string.
     */
    public function getAgeTextAttribute(): string
    {
        if (!$this->birth_date) {
            return 'Âge inconnu';
        }

        $years = $this->birth_date->age;
        $months = $this->birth_date->diffInMonths(now()) % 12;

        if ($years === 0) {
            return $months . ' mois';
        }

        if ($months === 0) {
            return $years . ($years === 1 ? ' an' : ' ans');
        }

        return $years === 1
            ? "1 an"
            : "$years ans";
    }


    /**
     * Get the number of days since arrival.
     */
    public function getDaysAtShelterAttribute(): ?int
    {
        return $this->arrived_at?->diffInDays(now());
    }

    // 1. L'Accesseur (Génère la chaîne)
    public function getSlugAttribute(): string
    {
        return $this->id . '-' . Str::slug($this->name);
    }

    public function getRouteKey(): string
    {
        return $this->slug;
    }

    public function resolveRouteBinding($value, $field = null): Model|Pet|null
    {
        $id = (int) $value;

        return $this->query()
            ->where('id', $id)
            ->firstOrFail();

    }

}
