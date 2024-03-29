<?php

namespace App\Models;

use App\Models\User;
use App\Models\Drivers;
use App\Models\UserTravelPlans;
use Illuminate\Database\Eloquent\Model;
use Encore\Admin\Auth\Database\Administrator;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TravelPlans extends Model
{

    protected $fillable = [
        'id',
        'name',
        'description',
        'meeting_point',
        'depart_name',
        'depart_lat',
        'depart_long',
        'destination_name',
        'destination_lat',
        'destination_long',
        'fees',
        'is_student',
        'num_passengers',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [];

    protected $casts = [];

    public function creator(){
        return $this->belongsTo(Drivers::class,'creator_id');
    }

    public function users(){
        return $this->belongsToMany(User::class, UserTravelPlans::class,'travel_plan_id', 'user_id');
    }

    public function userTravelPlans(){
        return $this->hasMany(UserTravelPlans::class);
    }
    public function rate(){
        return $this->userTravelPlans()->selectRaw('avg(rate) as driver_rate');
    }


}
