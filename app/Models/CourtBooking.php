<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourtBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'court_name',
        'price',
        'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
