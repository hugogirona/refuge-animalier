<?php

namespace App\Models;

use App\Enums\ContactMessageStatus;
use Database\Factories\ContactMessageFactory;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactMessage extends Model
{
    /** @use HasFactory<ContactMessageFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'content',
        'status',
        'read_at',
        'replied_at',
        'replied_by',
    ];

    protected function casts(): array
    {
        return [
            'status' => ContactMessageStatus::class,
            'read_at' => 'datetime',
            'replied_at' => 'datetime',
        ];
    }

    /**
     * Get the user who replied to this message.
     */
    public function replier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'replied_by');
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */
    #[Scope]
    public function new($query)
    {
        return $query->where('status', ContactMessageStatus::NEW);
    }
    #[Scope]
    public function read($query)
    {
        // Peut inclure READ et REPLIED selon votre logique, ici strict READ
        return $query->where('status', ContactMessageStatus::READ);
    }
    #[Scope]
    public function replied($query)
    {
        return $query->where('status', ContactMessageStatus::REPLIED);
    }

    /*
    |--------------------------------------------------------------------------
    | Actions
    |--------------------------------------------------------------------------
    */

    public function markAsRead(): void
    {
        // On ne change le statut que s'il est encore 'Nouveau'
        if ($this->status === ContactMessageStatus::NEW) {
            $this->update([
                'status' => ContactMessageStatus::READ,
                'read_at' => now(),
            ]);
        }
    }

    public function markAsReplied(User $user): void
    {
        $this->update([
            'status' => ContactMessageStatus::REPLIED,
            'replied_at' => now(),
            'replied_by' => $user->id,
            // Si pas encore lu (cas rare), on marque lu aussi
            'read_at' => $this->read_at ?? now(),
        ]);
    }

    public function getFormattedDateAttribute(): string
    {
        return $this->created_at->format('d/m/Y à H:i');
    }
}
