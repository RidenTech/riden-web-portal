<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PassengerReview extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'passenger_id',
        'driver_id',
        'reviewer_name',
        'rating',
        'review_text'
    ];

    public function passenger()
    {
        return $this->belongsTo(Passenger::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}
