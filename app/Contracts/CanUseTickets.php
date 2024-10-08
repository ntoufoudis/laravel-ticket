<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Relations\HasMany;

interface CanUseTickets
{
    public function tickets(): HasMany;
}
