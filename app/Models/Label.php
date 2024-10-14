<?php

namespace App\Models;

use App\Traits\HasVisibility;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Label extends Model
{
    use HasFactory, HasVisibility;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array<string>|bool
     */
    protected $guarded = [];

    /**
     * Get Tickets Relationship
     */
    public function tickets(): HasMany
    {
        return $this->HasMany(Ticket::class);
    }

    /**
     * Search Scope
     */
    public function scopeSearch($query, $value): void
    {
        $query->where('name', 'like', '%'.$value.'%')
            ->orWhere('slug', 'like', '%'.$value.'%');
    }
}
