<?php

namespace App\Http\Controllers;

use App\Models\TravelPlans;
use Illuminate\Http\Request;
use App\Models\UserTravelPlans;

class TravelPlanController extends Controller
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
        $travelModel = TravelPlans::skip($skip)->take($request->num_item);

        if($request->driver_id && $request->driver_id)  $travelModel = $travelModel->where('creator_id',$request->driver_id);
        if($request->min_fees && $request->min_fees)  $travelModel = $travelModel->where('fees','>=',$request->min_fees);
        if($request->max_fees && $request->max_fees)  $travelModel = $travelModel->where('fees','<=',$request->max_fees);
        if($request->status && $request->status)  $travelModel = $travelModel->where('status',$request->status);
        if($request->is_student && $request->is_student)  $travelModel = $travelModel->where('is_student',$request->is_student);
        if($request->origin_lat && $request->origin_long)  $travelModel = $travelModel->where('name',$request->name);
        if($request->destination_lat && $request->destination_long)  $travelModel = $travelModel->where('name',$request->name);
        
        $item = $travelModel->get();
        return response()->BaseResponse('200', '', $item);
    }

    public function getDetails(Request $request){
        $request->validate([
            'id' => 'required'
        ]);

        $item = TravelPlans::find($request->id);
        if(!$item) return response()->BaseResponse('404','Driver Not Found','');
        return response()->BaseResponse('200', '', $item);
    }

    
    public function joinTravelPlan(Request $request){
        $request->validate([
            'user_id' => 'required',
            'travel_plan_id' => 'required'
        ]);

        try{
            $userTravelPlan = new UserTravelPlans();
            $userTravelPlan->user_id = $request->user_id;
            $userTravelPlan->travel_plan_id = $request->travel_plan_id;
            $userTravelPlan->save();
        }catch(Throwable $ex){
            return response()->BaseResponse('500','System error');
        }
        return response()->BaseResponse('200','User has joined the travel plan',);
    }


}
