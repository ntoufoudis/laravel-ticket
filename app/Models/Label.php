<?php

namespace App\Models;

use App\Traits\HasVisibility;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_visible' => 'string',
        ];
    }

    public function getIsVisibleAttribute($value): string
    {
        $value = filter_var($value, FILTER_VALIDATE_BOOLEAN);
        if ($value == '') {
            return 'No';
        }

        return 'Yes';
    }

    /**
     * Get Tickets Relationship
     */
    public function tickets(): BelongsToMany
    {
        return $this->belongsToMany(Ticket::class);
    }

    public function scopeSearch($query, $value): void
    {
        $query->where('name', 'like', '%'.$value.'%')
            ->orWhere('slug', 'like', '%'.$value.'%');
    }
}
