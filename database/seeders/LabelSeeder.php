<?php

namespace Database\Seeders;

use App\Enums\Color;
use App\Models\Label;
use Illuminate\Database\Seeder;

class LabelSeeder extends Seeder
{
    public function run(): void
    {
        Label::factory()->create([
            'name' => 'Technical Issue',
            'slug' => 'technical-issue',
            'color' => Color::Orange->value,
        ]);

        Label::factory()->create([
            'name' => 'Customer Feedback',
            'slug' => 'customer-feedback',
            'color' => Color::Purple->value,
        ]);

        Label::factory()->create([
            'name' => 'Escalation',
            'slug' => 'escalation',
            'color' => Color::Gray->value,
        ]);

        Label::factory()->create([
            'name' => 'General Inquiries',
            'slug' => 'general-inquiries',
            'color' => Color::Yellow->value,
        ]);

        Label::factory()->create([
            'name' => 'Billing & Payments',
            'slug' => 'billing-payments',
            'color' => Color::Blue->value,
        ]);

        Label::factory()->create([
            'name' => 'Updates',
            'slug' => 'updates',
            'color' => Color::Green->value,
        ]);

        Label::factory()->create([
            'name' => 'Bug',
            'slug' => 'bug',
            'color' => Color::Red->value,

        ]);
    }
}
