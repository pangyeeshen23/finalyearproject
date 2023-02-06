<?php

namespace App\Http\Controllers;

use App\Models\TravelPlans;
use Illuminate\Http\Request;
use App\Models\UserTravelPlans;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

class TravelPlansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {
        // $request->validate([
        //     'num_item' => 'required',
        //     'page' => 'required',
        // ]);

        if($request->num_item == 0) $request->num_item = 10;
        if($request->page == 0) $request->page = 0;

        $travelModel = new TravelPlans();

        $minPrice = null;
        $maxPrice = null;

        $is_student_plan = null;

        if($request->price){
            switch($request->price){
                case("1"):
                    $minPrice = 1;
                    $maxPrice = 25;
                    break;
                case("2"):
                    $minPrice = 25;
                    $maxPrice = 50;
                break;
                case("3"):
                    $minPrice = 50;
                    $maxPrice = 75;
                break;
                case("4"):
                    $minPrice = 75;
                    $maxPrice = 100;
                break;
            }
        }

        if($request->travel_plan_type){
            switch($request->travel_plan_type){
                case("1"):
                    $is_student_plan = 0;
                break;
                case("2"):
                    $is_student_plan = 1;
                break;
            }
        }

        if($request->search && $request->search)  $travelModel = $travelModel->where('name', 'LIKE', '%'.$request->search.'%');
        if($minPrice)  $travelModel = $travelModel->where('fees','>=',$minPrice);
        if($maxPrice)  $travelModel = $travelModel->where('fees','<=',$maxPrice);
        if($is_student_plan)  $travelModel = $travelModel->where('is_student',$is_student_plan);
        
        $travelPlans =  $travelModel->paginate(10);

        return Inertia::render('TravelPlan', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'travelPlans' => $travelPlans
        ]);
    }

    public function details(Request $request){
        $request->validate([
            'id' => 'required'
        ]);

        $item = TravelPlans::find($request->id);
        if(!$item) return response()->BaseResponse('404','Driver Not Found','');
        return response()->BaseResponse('200', '', $item);
    }

    
    public function join(Request $request){
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
    
    public function rate(Request $request){
        $request->validate([
            'user_travel_plan_id' => 'required',
            'rate' => 'required',
        ]);

        $userTravelPlans  = UserTravelPlans::find($request->user_travel_plan_id);
        $userTravelPlans->rate = $request->rate;
        $userTravelPlans->save();

        return response()->BaseResponse('200', 'Rate Success', '');
    }
    

}
