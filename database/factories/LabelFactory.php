<?php

namespace Database\Factories;

use App\Enums\Color;
use App\Models\Label;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class LabelFactory extends Factory
{
    protected $model = Label::class;

    public function definition(): array
    {
        return [
            'name' => $name = $this->faker->unique()->words(2, true),
            'slug' => Str::slug($name),
            'is_visible' => $this->faker->boolean(),
            'color' => $this->faker->randomElement(Color::cases()),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
