<?php

namespace Database\Factories;

use App\Models\Label;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class LabelFactory extends Factory
{
    protected $model = Label::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'slug' => $this->faker->slug(),
            'is_visible' => $this->faker->boolean(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
