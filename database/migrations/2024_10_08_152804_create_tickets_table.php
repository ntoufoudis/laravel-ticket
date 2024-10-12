<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->uuid()->default(uuid_create());
            $table->foreignIdFor(User::class)->nullable()->constrained();
            $table->unsignedBigInteger('assigned_to')->nullable();
            $table->foreign('assigned_to')->references('id')->on('users');
            $table->string('subject');
            $table->string('message')->nullable();
            $table->string('priority')->default('low');
            $table->string('status')->default('open');
            $table->boolean('is_resolved')->default(false);
            $table->boolean('is_locked')->default(false);
            $table->integer('pin')->default(0000);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
