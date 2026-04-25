<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Driver extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'unique_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'gender',
        'avatar',
        'status',
        'is_online',
    ];

    public function getNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function vehicle()
    {
        return $this->hasOne(Vehicle::class);
    }

    public function documents()
    {
        return $this->hasMany(DriverDocument::class);
    }

    public function receivedReviews()
    {
        return $this->hasMany(Review::class, 'driver_id');
    }

    public function givenReviews()
    {
        return $this->hasMany(PassengerReview::class, 'driver_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'driver_id');
    }
}
