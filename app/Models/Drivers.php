<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Encore\Admin\Auth\Database\Role;

class Drivers extends Model
{
    use HasFactory;

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
}
