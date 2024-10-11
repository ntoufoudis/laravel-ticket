<?php

namespace Database\Factories;

use App\Models\Agent;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class TicketFactory extends Factory
{
    protected $model = Ticket::class;

    public function definition(): array
    {
        return [
            'uuid' => $this->faker->uuid(),
            'subject' => $this->faker->title(),
            'message' => $this->faker->realText(),
            'priority' => $this->faker->randomElement(['low', 'normal', 'high']),
            'status' => $this->faker->randomElement(['open', 'closed']),
            'is_resolved' => $this->faker->boolean(),
            'is_locked' => $this->faker->boolean(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
