<?php

namespace App\Models;

use Database\Factories\InternalNoteFactory;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InternalNote extends Model
{
    /** @use HasFactory<InternalNoteFactory> */
    use HasFactory;

    protected $fillable = [
        'notable_type',
        'notable_id',
        'content',
        'user_id',
    ];

    /**
     * Get the parent notable model (Pet, AdoptionRequest, etc.).
     */
    public function notable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get the user who created the note.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope to get notes for a specific model.
     */
    #[Scope]
    protected function for($query, Model $model)
    {
        return $query->where('notable_type', get_class($model))
            ->where('notable_id', $model->id);
    }

    /**
     * Get the author's name.
     */
    public function getAuthorNameAttribute(): string
    {

        return $this->user?->full_name ?? 'Utilisateur Inconnu';
    }

    /**
     * Get formatted creation date.
     */
    public function getFormattedDateAttribute(): string
    {
        return $this->created_at->format('d/m/Y à H:i');
    }

}
