<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    public function run(): void
    {
        Team::factory()->create([
            'name' => 'Customer Support',
            'description' => 'Customer support team',
        ]);

        Team::factory()->create([
            'name' => 'Sales',
            'description' => 'Sales team',
        ]);

        Team::factory()->create([
            'name' => 'Marketing',
            'description' => 'Marketing team',
        ]);
    }
}
