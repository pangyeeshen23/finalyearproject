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

        DB::table('admin_users')->insert(
            [
                [
                    'username' => 'driver',
                    'password' => Hash::make('123qwe123'),
                    'name'     => 'Driver',
                    'avatar'     => 'images/cc32285e7313262a2975836fa4f82be1.jpg',
                    'remember_token'     => 'jMAJp1E3VpVEIl8CuZJDw8wrqAHutYX8vqnO7DT1rCNVBCHR1b7gTb4wzxOd',
                    'created_at'     => '2022-12-13 13:52:29',
                    'updated_at'     => '2023-01-31 16:21:31',
                    'email_address'     => 'driver1@gmail.com',
                    'phone_number'     => '0123330172',
                    'identity_card_number'     => '83314421',
                    'age'     => '25',
                    'birthday'     => '2022-12-12',
                    'is_approved'     => '1',
                ]
            ]
        );
               

        DB::table('admin_role_users')->insert(
            [
                [
                    'role_id' => 1,
                    'user_id' => 1,
                ],
                [
                    'role_id' => 2,
                    'user_id' => 2,
                ]
            ]
        );
    }
}
