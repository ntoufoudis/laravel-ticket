<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Vasileios Ntoufoudis',
            'email' => 'info@ntoufoudis.com',
        ]);

        $user->assignRole('Super-Admin');

        $users = User::factory(10)->create();

        foreach ($users as $user) {
            $user->assignRole('agent');
        }
    }
}
