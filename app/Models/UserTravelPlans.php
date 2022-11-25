<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTravelPlans extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'travel_plan_id',
        'rate',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [];

    protected $casts = [];
}
