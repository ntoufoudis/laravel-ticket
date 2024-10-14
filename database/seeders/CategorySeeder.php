<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::factory()->create([
            'name' => 'Account',
            'slug' => 'account',
        ]);

        Category::factory()->create([
            'name' => 'Email',
            'slug' => 'email',
        ]);

        Category::factory()->create([
            'name' => 'Files',
            'slug' => 'files',
        ]);

        Category::factory()->create([
            'name' => 'DNS',
            'slug' => 'dns',
        ]);

        Category::factory()->create([
            'name' => 'WordPress',
            'slug' => 'wordpress',
        ]);

        Category::factory()->create([
            'name' => 'Dedicated Servers',
            'slug' => 'dedicated-servers',
        ]);

        Category::factory()->create([
            'name' => 'Website Builders',
            'slug' => 'website-builders',
        ]);

        Category::factory()->create([
            'name' => 'Email Client',
            'slug' => 'email-client',
        ]);

        Category::factory()->create([
            'name' => 'General Inquiry',
            'slug' => 'general-inquiry',
        ]);

        Category::factory()->create([
            'name' => 'Site Management',
            'slug' => 'site-management',
        ]);

        Category::factory()->create([
            'name' => 'Troubleshooting',
            'slug' => 'troubleshooting',
        ]);

        Category::factory()->create([
            'name' => 'PHP',
            'slug' => 'php',
        ]);
    }
}
