<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRoles extends Model
{

    protected $fillable = [
        'id',
        'name',
        'slug',
        'created_at',
        'updated_at'
    ];
}
