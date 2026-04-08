<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Passenger extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'unique_id',
        'first_name',
        'last_name',
        'email',
        'password',
        'phone',
        'gender',
        'avatar',
        'status'
    ];

    protected $hidden = [
        'password',
    ];
}
