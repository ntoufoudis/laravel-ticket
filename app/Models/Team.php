<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array<string>|bool
     */
    protected $guarded = [];

    public function scopeSearch($query, $value): void
    {
        $query->where('name', 'like', '%'.$value.'%')
            ->orWhere('description', 'like', '%'.$value.'%');
    }
}
