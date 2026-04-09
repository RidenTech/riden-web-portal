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

    public function vehicle()
    {
        return $this->hasOne(Vehicle::class);
    }

    public function documents()
    {
        return $this->hasMany(DriverDocument::class);
    }
}
