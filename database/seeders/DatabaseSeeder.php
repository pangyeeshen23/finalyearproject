<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\UserTravelPlans;

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
                "name"=> "Ewald",
                "email"=> "demo@gmail.com",
                "email_verified_at"=> NULL,
                "password"=> Hash::make('123qwe123'),
                "remember_token"=> NULL,
                "created_at"=> "2022-12-10 16:28:31",
                "updated_at"=> "2023-02-04 08:40:55",
                "role_id"=> "2",
                "birthday"=> "2022-10-05",
                "username"=> "JenniferFRandolph"
            ],
            [
                "name"=> "Canady",
                "email"=> "demo2@gmail.com",
                "email_verified_at"=> NULL,
                "password"=>  Hash::make('123qwe123'),
                "remember_token"=> NULL,
                "created_at"=> "2023-02-05 07:18:34",
                "updated_at"=> "2023-02-05 07:18:34",
                "role_id"=> "1",
                "birthday"=> "1997-10-23",
                "username"=> "DanielEGarrett"
            ],
            [
                "name"=> "Logue",
                "email"=> "demo3@gmail.com",
                "email_verified_at"=> NULL,
                "password"=> Hash::make('123qwe123'),
                "remember_token"=> NULL,
                "created_at"=> "2023-02-05 07:58:13",
                "updated_at"=> "2023-02-05 07:58:13",
                "role_id"=> "1",
                "birthday"=> "1887-02-12",
                "username"=> "DorothyJKnight"
            ],
            [
                "name"=> "Adams",
                "email"=> "demo5@gmail.com",
                "email_verified_at"=> "2023-02-04 08:38:49",
                "password"=> Hash::make('123qwe123'),
                "remember_token"=> NULL,
                "created_at"=> "2023-02-04 08:39:09",
                "updated_at"=> "2023-02-04 08:39:09",
                "role_id"=> "2",
                "birthday"=> "2023-02-04",
                "username"=> "ArmindaMIsaacson"
            ],
        ]);

        \App\Models\TravelPlans::insert([
            [
                "name"=> "[IOI City Mall - KL Sentral]",
                "description"=> "Depart Date : 10 Jan 2023,Depart Time : 12:00 A.M, Vehicle : Honda Civic",
                "meeting_point"=> "IOI City Mall Gate A",
                "depart_name" => "IOI City Mall", 
                "depart_lat"=> "2.970663",
                "depart_long"=> "101.7136681",
                "destination_name" => "KL Sentral", 
                "destination_lat"=> "3.1349853",
                "destination_long"=> "101.6860558",
                "fees"=> "5",
                "is_student"=> "0",
                "creator_id"=> "2",
                "num_passengers" => "2",
                "created_at" => "2023-01-10 13:34:28",
                "updated_at" => "2023-01-10 13:34:28",
                "status" => "3"
            ],
            [
                "name"=> "[Sunway Pyramid - SS15 Courtyard]",
                "description"=> "Depart Date : 25 Spet 2023,Depart Time : 1:00 P.M, Vehicle : Myvi",
                "meeting_point"=> "Sunway Pyramid Main Gate",
                "depart_name" => "Sunway Pyramid", 
                "depart_lat"=> "3.0720837",
                "depart_long"=> "101.6063455",
                "destination_name" => "SS15 Courtyard", 
                "destination_lat"=> "3.077482400000001",
                "destination_long"=> "101.5866001",
                "fees"=> "10",
                "is_student"=> "1",
                "creator_id"=> "2",
                "num_passengers" => "6",
                "created_at" => "2023-02-16 13:34:28",
                "updated_at" => "2023-02-16 13:34:28",
                "status" => "1"
            ],
            [
                "name"=> "[KL Gate Way University - Amcorp Mall]",
                "description"=> "Depart Date : 15 Oct 2023,Depart Time : 5:00 P.M, Vehicle : BMW",
                "meeting_point"=> "KL Gate Way University Main Gate",
                "depart_name" => "KL Gate Way University", 
                "depart_lat"=> "3.114111",
                "depart_long"=> "101.6632703",
                "destination_name" => "Amcorp Mall", 
                "destination_lat"=> "3.105097",
                "destination_long"=> "101.646955",
                "fees"=> "5",
                "is_student"=> "0",
                "creator_id"=> "3",
                "num_passengers" => "3",
                "created_at" => "2023-02-16 13:34:28",
                "updated_at" => "2023-02-16 13:34:28",
                "status" => "1"
            ],
            [
                "name"=> "[Day To Day Restaurant - Amcorp Mall]",
                "description"=> "Depart Date : 15 Oct 2023,Depart Time : 5:00 P.M, Vehicle : Vellfire",
                "meeting_point"=> "Day To Day Restaurant",
                "depart_name" => "Day To Day Restaurant", 
                "depart_lat"=> "3.0671973",
                "depart_long"=> "101.6318279",
                "destination_name" => "Amcorp Mall", 
                "destination_lat"=> "3.105097",
                "destination_long"=> "101.646955",
                "fees"=> "10",
                "is_student"=> "0",
                "creator_id"=> "4",
                "num_passengers" => "5",
                "created_at" => "2023-02-16 13:34:28",
                "updated_at" => "2023-02-16 13:34:28",
                "status" => "1"
            ],
            [
                "name"=> "[Thean Hou Temple - KL Sentral]",
                "description"=> "Depart Date : 15 Oct 2023,Depart Time : 5:00 P.M, Vehicle : BMW",
                "meeting_point"=> "Thean Hou Temple",
                "depart_name" => "Thean Hou Temple", 
                "depart_lat"=> "3.1219525",
                "depart_long"=> "101.6876678",
                "destination_name" => "KL Sentral", 
                "destination_lat"=> "3.1349853",
                "destination_long"=> "101.6860558",
                "fees"=> "25",
                "is_student"=> "0",
                "creator_id"=> "2",
                "num_passengers" => "3",
                "created_at" => "2023-02-16 13:34:28",
                "updated_at" => "2023-02-16 13:34:28",
                "status" => "1"
            ],
        ]);

        UserTravelPlans::insert([
            [
                "user_id"=> "1",
                "travel_plans_id"=> "1",
                "rate" => "4",
                "creator_id"=> "2",
            ],
            [
                "user_id"=> "2",
                "travel_plans_id"=> "1",
                "rate" => "3",
                "creator_id"=> "2",
            ]
        ]);
    }
}
