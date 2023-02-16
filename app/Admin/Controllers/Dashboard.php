<?php

namespace App\Admin\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Drivers;
use App\Models\TravelPlans;
use Illuminate\Support\Arr;
use App\Models\UserTravelPlans;
use Encore\Admin\Facades\Admin;
use Doctrine\DBAL\Logging\Driver;
use Illuminate\Support\Facades\DB;
use Encore\Admin\Auth\Database\Administrator;

class Dashboard
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public static function title()
    {
        return view('admin::dashboard.title');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public static function totalCount()
    {
        $title = 'Total User Counts';

        $totalCountUser = User::whereHas('role',function($query){
            $query->where('slug','DEFAULT');
        })->get()->count();

        $totalCountStudent = User::whereHas('role',function($query){
            $query->where('slug','STUDENT');
        })->get()->count();


        $totalCountAdmin = Administrator::whereHas('roles',function($query){
            $query->where('slug','administrator');
        })->get()->count();

        $totalCountDriver = Drivers::whereHas('roles',function($query){
            $query->where('slug','driver');
        })->get()->count();

        $totalCounts = [
            ['name' => 'User',       'value' => $totalCountUser],
            ['name' => 'Student',   'value' =>  $totalCountStudent],
            ['name' => 'Driver',               'value' => $totalCountDriver],
            ['name' => 'Admin',             'value' => $totalCountAdmin],
        ];

        return view('dashboard.table', compact('totalCounts','title'));
    }

    public static function totalCountTravelPlans()
    {
        $title = 'Total Travel Plan Counts';

        $totalCountPendingQuery = TravelPlans::where('status', 1);
        if(Admin::user()->isRole('driver')) $totalCountPendingQuery = $totalCountPendingQuery->where('creator_id', Admin::user()->id);
        $totalCountPending = $totalCountPendingQuery
        ->get()
        ->count();

        $totalCountInProgressQuery = TravelPlans::where('status', 2);
        if(Admin::user()->isRole('driver')) $totalCountInProgressQuery = $totalCountInProgressQuery->where('creator_id', Admin::user()->id);
        $totalCountInProgress = $totalCountInProgressQuery
        ->get()
        ->count();

        $totalCountCompleteQuery = TravelPlans::where('status', 3);
        if(Admin::user()->isRole('driver')) $totalCountCompleteQuery = $totalCountCompleteQuery->where('creator_id', Admin::user()->id);
        $totalCountComplete = $totalCountCompleteQuery
        ->get()
        ->count();

        $totalCounts = [
            ['name' => 'Pending',       'value' => $totalCountPending],
            ['name' => 'In Progress',   'value' => $totalCountInProgress],
            ['name' => 'Complete',               'value' => $totalCountComplete],
        ];

        return view('dashboard.table', compact('totalCounts','title'));
    }

    public static function travelPlansType()
    {
        $title = 'Travel Plan Type';
        $defaultTypeQuery = TravelPlans::where('is_student', 0);
        if(Admin::user()->isRole('driver')) $defaultTypeQuery = $defaultTypeQuery->where('creator_id', Admin::user()->id);
        $defaultType = $defaultTypeQuery
        ->get()
        ->count();

        $studentTypeQuery = TravelPlans::where('is_student', 1);
        if(Admin::user()->isRole('driver')) $studentTypeQuery = $studentTypeQuery->where('creator_id', Admin::user()->id);
        $studentType = $studentTypeQuery
        ->get()
        ->count();


        $totalCounts = [
            ['name' => 'Default',       'value' => $defaultType],
            ['name' => 'For Student',   'value' => $studentType],
        ];



        return view('dashboard.table', compact('totalCounts','title'));
    }

    public static function ratingCount()
    {
        $title = 'Top 5 Driver By Rating';
        $totalCounts = UserTravelPlans::leftJoin('travel_plans', 'user_travel_plans.travel_plans_id', '=', 'travel_plans.id')
        ->leftJoin('admin_users', 'travel_plans.creator_id', '=', 'admin_users.id')
        ->groupBy('travel_plans.creator_id')
        ->select(['admin_users.name AS name', DB::raw('CAST(AVG(rate) AS UNSIGNED) AS value')])
        ->orderBy('value', 'DESC')
        ->take(5)->get();

        return view('dashboard.table',compact('totalCounts','title'));
    }
    
    public static function monthlyTravelPlansCount()
    {
        $title = 'Monthly Travel Plans Count';
        $chartId = 'monthlyTravelPlan';

        $stats = [];
        for($i = 11; $i >= 0; $i--){
            $date = Carbon::now()->subMonths($i);
            $month = $date->month;
            $year = $date->year;
            $countQuery = TravelPlans::whereYear('created_at', '=', $year)
            ->whereMonth('created_at', '=', $month);

            if(Admin::user()->isRole('driver')) $countQuery = $countQuery->where('creator_id', Admin::user()->id);
            
            $count = $countQuery->get()->count();

            array_push($stats, (object)['name' =>  $date->format('M'), 'value' => $count]);
        }


        $data = (object) [
            "labels" => array_map(function($item){
                return $item->name;
            }, $stats),
            "datasets" => [
                (object) [
                    "label"=> 'Number of Count',
                    "data"=>  array_map(function($item){
                        return $item->value;
                    }, $stats),
                    "backgroundColor"=> [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                    ],
                    "borderColor"=>  [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                    ],
                    "borderWidth"=> 1,
                ]
            ],
            "options"=> (object) [
                "scales"=> (object) [
                    "yAxes"=> [
                        (object) [
                        "ticks"=>  (object) [
                            'beginAtZero'=> true,
                            ]
                        ]
                    ]
                ]
            ]
        ];

        return view('dashboard.line', compact('title','data','chartId'));
    }

    public static function driverRating()
    {
        $title = 'Driver Rating';
        $totalCounts = UserTravelPlans::leftJoin('travel_plans', 'user_travel_plans.travel_plans_id', '=', 'travel_plans.id')
        ->leftJoin('admin_users', 'travel_plans.creator_id', '=', 'admin_users.id')
        ->groupBy('travel_plans.creator_id')
        ->select(['admin_users.name AS name', DB::raw('CAST(AVG(rate) AS UNSIGNED) AS value')])
        ->orderBy('value', 'DESC')
        ->where('travel_plans.creator_id', Admin::user()->id)
        ->get();


        if(!$totalCounts->first()) $totalCounts = [
            [ 'name' => Admin::user()->username, 'value' => 0]
        ];


        return view('dashboard.table',compact('totalCounts','title'));
    }
}

    
