<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserStudentApplications extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'file_name',
        'file_link',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [];

    protected $casts = [];
}
