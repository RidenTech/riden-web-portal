<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'driver_id',
        'model',
        'year',
        'color',
        'license_plate',
        'vehicle_type',
        'no_of_seats',
        'front_image',
        'back_image',
    ];

    /**
     * Get the full URL for the front image.
     * Useful for Mobile App API integration.
     */
    public function getFrontImageUrlAttribute()
    {
        return $this->front_image ? asset('uploads/vehicles/' . $this->front_image) : asset('assets/images/placeholder-car.png');
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}
