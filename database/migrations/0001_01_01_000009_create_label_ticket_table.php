<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('label_ticket', function (Blueprint $table) {
            $table->foreignId('label_id')->constrained('labels');
            $table->foreignId('ticket_id')->constrained('tickets');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('label_ticket');
    }
};
