<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'driver_reviews';

    protected $fillable = [
        'driver_id',
        'passenger_id',
        'reviewer_name',
        'rating',
        'review_text'
    ];

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function passenger()
    {
        return $this->belongsTo(Passenger::class);
    }
}
