<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_users')->insert(
            [
                [
                    'username' => 'admin',
                    'password' => Hash::make('admin'),
                    'name'     => 'Administrator',
                ]
            ]
        );

        DB::table('admin_role_users')->insert(
            [
                [
                    'role_id' => 1,
                    'user_id' => 1,
                ]
            ]
        );
    }
}
