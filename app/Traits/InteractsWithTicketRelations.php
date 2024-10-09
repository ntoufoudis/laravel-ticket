<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

trait InteractsWithTicketRelations
{
    /**
     * Associate Labels into an existing ticket
     */
    public function attachLabels(mixed $id, array $attributes = [], bool $touch = true): void
    {
        $this->labels()->attach($id, $attributes, $touch);
    }

    /**
     * Sync the intermediate tables with a list of IDs or collection of the ticket model
     */
    public function syncLabels(Model|array|Collection $ids, bool $detaching = true): array
    {
        return $this->labels()->sync($ids, $detaching);
    }

    /**
     * Associate Categories into an existing ticket
     */
    public function attachCategories(mixed $id, array $attributes = [], bool $touch = true): void
    {
        $this->categories()->attach($id, $attributes, $touch);
    }

    /**
     * Sync the intermediate tables with a list of IDs or collection of the ticket model
     */
    public function syncCategories(Model|array|Collection $ids, bool $detaching = true): array
    {
        return $this->categories()->sync($ids, $detaching);
    }

    /**
     * Add new message on an existing ticket
     */
    public function message(string $message): Model
    {
        return $this->messageAsUser(auth()->user(), $message);
    }

    /**
     * Add new message on an existing ticket as a custom user
     */
    public function messageAsUser(?Model $user, string $message): Model
    {
        return $this->messages()->create([
            'user_id' => $user?->id ?? auth()->id(),
            'message' => $message,
        ]);
    }
}
