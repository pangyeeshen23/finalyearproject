<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'description',
        'meeting_point',
        'lat',
        'long',
        'fees',
        'is_student',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [];

    protected $casts = [];


}
