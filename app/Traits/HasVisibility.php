<?php

namespace App\Traits;

use App\Enums\Visibility;
use Illuminate\Database\Eloquent\Builder;

trait HasVisibility
{
    /**
     * Determine whether the model is visible or not.
     */
    public function scopeVisible(Builder $builder): Builder
    {
        return $builder->where('is_visible', Visibility::VISIBLE->value);
    }

    /**
     * Determine whether the model is hidden or not.
     */
    public function scopeHidden(Builder $builder): Builder
    {
        return $builder->where('is_visible', Visibility::HIDDEN->value);
    }
}
