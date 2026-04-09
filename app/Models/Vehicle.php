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
    ];

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}
