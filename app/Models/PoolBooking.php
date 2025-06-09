<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoolBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'session_name',
        'price',
        'start_time',
        'end_time',
        'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
