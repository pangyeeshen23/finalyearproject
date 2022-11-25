<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Encore\Admin\Auth\Database\Administrator;

class TravelPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'description',
        'meeting_point',
        'depart_lat',
        'depart_long',
        'destination_lat',
        'destination_long',
        'fees',
        'is_student',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [];

    protected $casts = [];

    public function admins(){
        return $this->belongsTo(Admin::class. 'creator_id');
    }

}
