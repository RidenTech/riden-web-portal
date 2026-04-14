<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class Passenger extends Authenticatable
{
    use HasApiTokens, HasFactory, SoftDeletes;

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
