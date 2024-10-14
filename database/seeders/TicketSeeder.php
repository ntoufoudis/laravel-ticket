<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Label;
use App\Models\Ticket;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();
        $labels = Label::all();

        foreach ($categories as $category) {
            Ticket::factory(rand(5, 15))->create([
                'category_id' => $category->id,
            ]);
        }

        foreach (Ticket::all() as $ticket) {
            $ticket->label()->associate(rand(1, count($labels)))->save();
        }
    }
}
