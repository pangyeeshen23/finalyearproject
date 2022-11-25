<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vechicles extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'plate_number',
        'model',
        'color',
        'creator_id',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [];

    protected $casts = [];
}
