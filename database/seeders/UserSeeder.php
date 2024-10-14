<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $superAdmin = User::factory()->create([
            'name' => 'Vasileios Ntoufoudis',
            'email' => 'info@ntoufoudis.com',
        ]);

        $superAdmin->assignRole('Super-Admin');

        $user = User::factory()->create([
            'name' => 'Vasilios Ntoufoudis',
            'email' => 'doufoudis@gmail.com',
        ]);

        $user->assignRole('user');

        $users = User::factory(50)->create();

        foreach ($users as $user) {
            $user->assignRole('agent');
            $user->team()->associate(rand(1, 3))->save();
        }
    }
}
