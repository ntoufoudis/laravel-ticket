<?php

namespace App\Models;

use App\Traits\HasVisibility;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    use HasFactory, HasVisibility;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array<string>|bool
     */
    protected $guarded = [];
}
