<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use SoftDeletes;

    protected $table = 'reviews';

    protected $fillable = [
        'review_type', // 'driver' or 'passenger'
        'driver_id',
        'passenger_id',
        'reviewer_name',
        'rating',
        'review_text'
    ];

    /**
     * The subject of the review if it's a driver review
     */
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    /**
     * The subject of the review if it's a passenger review
     */
    public function passenger()
    {
        return $this->belongsTo(Passenger::class);
    }

    /**
     * Scope to filter by type
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('review_type', $type);
    }
}
