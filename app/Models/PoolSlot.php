<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoolSlot extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', // e.g., 'Early Morning', 'Afternoon', etc.
        'start_time',
        'end_time',
        'price',
    ];
}
