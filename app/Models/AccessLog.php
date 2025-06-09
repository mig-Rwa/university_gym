<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'accessed_at',
        'access_point',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
