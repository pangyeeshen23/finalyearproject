<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Drivers;
use Illuminate\Http\Request;
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

        $rating = null;
        
        $driverModel =  $driverModel->whereHas('roles',function($query){
            $query->where('slug','driver');
        })->with('avgRate');

        if($request->search && $request->search)  $driverModel = $driverModel->where('name', 'LIKE', '%'.$request->search.'%');
        $drivers =  $driverModel->paginate(10);


        return Inertia::render('Driver', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'drivers' => $drivers
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
