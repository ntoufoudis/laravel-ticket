<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        return [
            'name' => $name = $this->faker->unique()->words(2, true),
            'slug' => Str::slug($name),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
