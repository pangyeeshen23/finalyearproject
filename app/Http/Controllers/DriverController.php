<?php

namespace App\Http\Controllers;

use App\Models\Drivers;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll(Request $request)
    {
        $request->validate([
            'num_item' => 'required',
            'page' => 'required',
        ]);

        $skip = $request->num_item  * $request->page;
        $driverModel = Drivers::with('avgRate')->skip($skip)->take($request->num_item);

        if($request->name && $request->name != null)  $driverModel = $driverModel->where('name',$request->name);
        if($request->age && $request->age != null)  $driverModel = $driverModel->where('age',$request->age);
        // if($request->rate && $request->rate != null)  $driverModel = $driverModel->where('rate',$request->rate);

        $item = $driverModel->get();
        return response()->BaseResponse('200', '', $item);
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
