<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourtSlot extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', // e.g., 'Basketball Court', 'Tennis Court', etc.
        'price',
        'start_time',
        'end_time',
    ];
}
