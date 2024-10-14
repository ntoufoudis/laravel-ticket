<?php

namespace App\Models;

use App\Traits\InteractsWithTicketRelations;
use App\Traits\InteractsWithTickets;
use App\Traits\TicketScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ticket extends Model
{
    use HasFactory, InteractsWithTicketRelations, InteractsWithTickets, TicketScope;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array<string>|bool
     */
    protected $guarded = [];

    /**
     * Get User Relationship
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get Assigned To User Relationship
     */
    public function assignedToUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    /**
     * Get Messages Relationship
     */
    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    /**
     * Get Categories Relationship
     */
    public function category(): BelongsTo
    {
        return $this->BelongsTo(Category::class);
    }

    /**
     * Get Labels Relationship
     */
    public function label(): BelongsTo
    {
        return $this->BelongsTo(Label::class);
    }

    public function scopeSearch($query, $value): void
    {
        $query->where('subject', 'like', '%'.$value.'%');
    }

    public function scopeStatus($query, $value): void
    {
        if ($value === 'open' || $value === 'closed') {
            $query->where('status', $value);
        }
    }

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['category', 'label'];
}
