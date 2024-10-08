<?php

namespace App\Traits;

use App\Models\Message;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasTickets
{
    /**
     * Get User tickets relationship
     */
    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'user_id');
    }

    /**
     * Get User messages relationship
     */
    public function messages(): HasMany
    {
        return $this->hasMany(Message::class, 'user_id');
    }
}
