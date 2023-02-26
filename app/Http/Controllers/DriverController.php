<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Drivers;
use App\Models\TravelPlans;
use Illuminate\Http\Request;
use App\Models\UserTravelPlans;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {
        $driverModel = new Drivers();

        $sortBy = 'desc';
       
        $driverModel =  $driverModel->whereHas('roles',function($query){
            $query->where('slug','driver');
        })->withAvg('userTravelPlans as rate','rate');

        if($request->search)  $driverModel = $driverModel->where('name', 'LIKE', '%'.$request->search.'%');
        if($request->rateSortBy){
            switch($request->rateSortBy){
                case "0":
                    $sortBy = "desc";
                break;
                case "1":
                    $sortBy = "asc";
                break;
                default:
                    $sortBy = 'desc';
                break;
            }
        }
        $drivers =  $driverModel->orderBy('rate', $sortBy)->paginate(10);
        return Inertia::render('Driver', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'drivers' => $drivers
        ]);
    }

    public function details(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);

        $driverModel = new Drivers();
        $sortBy = 'desc';
        $driver =  $driverModel->whereHas('roles',function($query){
            $query->where('slug','driver');
        })->where('id', $request->id)->withAvg('userTravelPlans as rate','rate')
        ->with('travelPlans', function($query){
            $query->where('status', 1);
        })->first();

        $totalCompletedTravelPLans =  TravelPlans::where('creator_id', $request->id)->where('status', 3)->count();
        $totalTravelPlans = TravelPlans::where('creator_id', $request->id)->count();
        $totalRatingReceived = UserTravelPlans::where('creator_id', $request->id)->where('rate', '!=', null)->count();

        return Inertia::render('DriverDetail', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'driver' => $driver,
            'totalCompletedTravelPLans' => $totalCompletedTravelPLans,
            'totalTravelPlans' => $totalTravelPlans,
            'totalRatingReceived' => $totalRatingReceived
        ]);
    }

    public function getAllAsOptions(Request $request)
    {
        $request->validate([
            'page' => 'required',
        ]);

        $skip = $request->num_item  * $request->page;
        $driverModel = Drivers::skip($skip)->take(10);
        $item = $driverModel->get();
        return response()->BaseResponse('200', '', $item);
    }

    public function getDetails(Request $request){
        $request->validate([
            'id' => 'required'
        ]);

        $item = Drivers::with('avgRate')->with('travelPlans')->with('travelPlans.rate')->find($request->id);
        if(!$item) return response()->BaseResponse('404','Driver Not Found','');
        return response()->BaseResponse('200', '', $item);
    }
}
