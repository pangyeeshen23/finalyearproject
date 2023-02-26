<?php

namespace App\Models;

use App\Models\User;
use App\Models\TravelPlans;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserTravelPlans extends Model
{

    protected $fillable = [
        'id',
        'user_id',
        'travel_plans_id',
        'rate',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [];

    protected $casts = [];

    
    public function travelPlan(){
        return $this->belongsTo(TravelPlans::class, 'travel_plans_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
