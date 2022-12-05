<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class UserStudentApplications extends Model
{

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

    public function user(){
        return $this->belongTo(User::class);
    }
}
