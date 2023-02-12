<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //\App\Models\UserRoles::truncate();
        \App\Models\UserRoles::insert([
            [
                "name"=> "Default",
                "slug"=> "DEFAULT"
            ],
            [
                "name"=> "Student",
                "slug"=> "STUDENT"
            ],
        ]);

        //\App\Models\User::truncate();
        \App\Models\User::insert([
            [
                "name"=> "bot23",
                "email"=> "demo@gmail.com",
                "email_verified_at"=> NULL,
                "password"=> Hash::make('123qwe123'),
                "remember_token"=> NULL,
                "created_at"=> "2022-12-10 16:28:31",
                "updated_at"=> "2023-02-04 08:40:55",
                "role_id"=> "2",
                "birthday"=> "2022-10-05",
                "username"=> "demo"
            ],
            [
                "name"=> "demo12",
                "email"=> "demo12@gmail.com",
                "email_verified_at"=> NULL,
                "password"=>  Hash::make('123qwe123'),
                "remember_token"=> NULL,
                "created_at"=> "2023-02-05 07:18:34",
                "updated_at"=> "2023-02-05 07:18:34",
                "role_id"=> "1",
                "birthday"=> "1997-10-23",
                "username"=> "demo12"
            ],
            [
                "name"=> "demo54",
                "email"=> "demo54@gmail.com",
                "email_verified_at"=> NULL,
                "password"=> Hash::make('123qwe123'),
                "remember_token"=> NULL,
                "created_at"=> "2023-02-05 07:58:13",
                "updated_at"=> "2023-02-05 07:58:13",
                "role_id"=> "1",
                "birthday"=> "1887-02-12",
                "username"=> "demo54"
            ],
            [
                "name"=> "user",
                "email"=> "user@gmail.com",
                "email_verified_at"=> "2023-02-04 08:38:49",
                "password"=> Hash::make('123qwe123'),
                "remember_token"=> NULL,
                "created_at"=> "2023-02-04 08:39:09",
                "updated_at"=> "2023-02-04 08:39:09",
                "role_id"=> "2",
                "birthday"=> "2023-02-04",
                "username"=> "user1"
            ],
        ]);
    }
}
