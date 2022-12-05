<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Driver;

class DriverApplications extends Model
{
    protected $fillable = [
        'id',
        'driver_id',
        'file_name',
        'file_link',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [];

    protected $casts = [];

    public function driver(){
        return $this->belongTo(Driver::class);
    }
}
