<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupportTicket extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'ticket_id',
        'user_type',
        'driver_id',
        'passenger_id',
        'booking_id',
        'complaint_type',
        'subject',
        'description',
        'status',
        'priority'
    ];

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function passenger()
    {
        return $this->belongsTo(Passenger::class);
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    /**
     * Helper to get the user name based on type
     */
    public function getUserNameAttribute()
    {
        if ($this->user_type === 'driver' && $this->driver) {
            return $this->driver->first_name . ' ' . $this->driver->last_name;
        } elseif ($this->user_type === 'passenger' && $this->passenger) {
            return $this->passenger->first_name . ' ' . $this->passenger->last_name;
        }
        return 'Unknown';
    }
}
