<?php

namespace App\Models;

use App\Enums\AdoptionRequestStatus;
use Database\Factories\ContactMessageFactory;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class AdoptionRequest extends Model
{
    /** @use HasFactory<ContactMessageFactory> */
    use HasFactory;

    protected $fillable = [
        'pet_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'city',
        'zip_code',
        'accommodation_type',
        'has_garden',
        'has_other_pets',
        'had_same',
        'available_days',
        'available_hours',
        'preferred_contact_method',
        'message',
        'newsletter_consent',
        'status',
        'notified_at',
        'processed_by',
    ];

    protected function casts(): array
    {
        return [
            'status' => AdoptionRequestStatus::class,
            'has_garden' => 'boolean',
            'newsletter_consent' => 'boolean',
            'available_days' => 'array',
            'available_hours' => 'array',
            'notified_at' => 'datetime',
            'adopted_at' => 'datetime',
        ];
    }

    public function pet(): BelongsTo
    {
        return $this->belongsTo(Pet::class);
    }

    public function processor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'processed_by');
    }

    /**
     * Get all internal notes for the adoption request.
     */
    public function internalNotes(): MorphMany
    {
        return $this->morphMany(InternalNote::class, 'notable')->latest();
    }

    /**
     * Add an internal note to the adoption request.
     */
    public function addInternalNote(string $content, User $user): InternalNote
    {
        return $this->internalNotes()->create([
            'content' => $content,
            'user_id' => $user->id,
        ]);
    }

    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }
    #[Scope]
    public function new($query)
    {
        return $query->where('status', AdoptionRequestStatus::NEW);
    }
    #[Scope]
    public function pending($query)
    {
        return $query->where('status', AdoptionRequestStatus::PENDING);
    }
}
