<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class Passenger extends Authenticatable
{
    use HasApiTokens, HasFactory, SoftDeletes;

    protected $fillable = [
        'unique_id',
        'first_name',
        'last_name',
        'email',
        'password',
        'phone',
        'gender',
        'avatar',
        'status'
    ];

    public function getNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    protected $hidden = [
        'password',
    ];

    public function receivedReviews()
    {
        return $this->hasMany(PassengerReview::class, 'passenger_id');
    }

    public function givenReviews()
    {
        return $this->hasMany(Review::class, 'passenger_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'passenger_id');
    }
}
