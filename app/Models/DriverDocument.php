<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DriverDocument extends Model
{
    protected $fillable = [
        'driver_id',
        'document_name',
        'file_path',
        'status',
        'rejection_reason',
    ];

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}
