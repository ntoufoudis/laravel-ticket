<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Team extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array<string>|bool
     */
    protected $guarded = [];

    /**
     * Get Agents Relationship
     */
    public function agents(): HasMany
    {
        return $this->HasMany(User::class, 'team_id');
    }

    /**
     * The relationships that should always be loaded.
     *
     * @var array<int, string>
     */
    protected $with = ['agents'];

    /**
     * Search Scope
     */
    public function scopeSearch($query, $value): void
    {
        $query->where('name', 'like', '%'.$value.'%')
            ->orWhere('description', 'like', '%'.$value.'%');
    }
}
