<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'booking_id',
        'passenger_id',
        'driver_id',
        'vehicle_id',
        'pickup_location',
        'dropoff_location',
        'distance',
        'duration',
        'fare',
        'payment_method',
        'payment_status',
        'card_last_four',
        'status',
        'pickup_time',
        'completed_time',
    ];

    protected $casts = [
        'pickup_time' => 'datetime',
        'completed_time' => 'datetime',
        'fare' => 'decimal:2',
    ];

    public function passenger()
    {
        return $this->belongsTo(Passenger::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
