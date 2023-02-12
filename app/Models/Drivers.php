<?php

namespace App\Models;

use App\Models\TravelPlans;
use App\Models\UserTravelPlans;
use App\Models\DriverApplications;
use Encore\Admin\Auth\Database\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Drivers extends Model
{

    protected $table = "admin_users";

    protected $fillable = [
        "username",
        "name",
        "avatar",
        "email_address",
        "phone_number",
        "identity_card_number",
        "age",
        "birthday",
        "is_approved"
    ];

    protected $hidden = [
        "remember_token",
        "password"
    ];

    protected $casts = [];

    public function roles()
    {
        $pivotTable = config('admin.database.role_users_table');

        $relatedModel = config('admin.database.roles_model');

        return $this->belongsToMany($relatedModel, $pivotTable, 'user_id', 'role_id');
    }

    public function driverApplication(){
        return $this->hasOne(DriverApplications::class, 'creator_id');
    }

    public function travelPlans(){
        return $this->hasMany(TravelPlans::class,'creator_id');
    }

    public function userTravelPlans(){
        return $this->hasMany(UserTravelPlans::class,'creator_id');
    }

    public function avgRate(){
        return $this->userTravelPlans()->with('userTravelPlans', function($query){
            $query->selectRaw('CAST(AVG(rate) AS UNSIGNED) as plan_rate');
        });
    }
}
