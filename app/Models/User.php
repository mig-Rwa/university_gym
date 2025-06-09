<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use App\Models\Membership;
use App\Models\Payment;
use App\Models\AccessLog;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'card_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function membership()
    {
        return $this->belongsTo(Membership::class);
    }
    
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function poolBookings()
    {
        return $this->hasMany(\App\Models\PoolBooking::class);
    }

    public function courtBookings()
    {
        return $this->hasMany(\App\Models\CourtBooking::class);
    }
    
    public function accessLogs()
    {
        return $this->hasMany(AccessLog::class);
    }
    
}
