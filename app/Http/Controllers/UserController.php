<?php

namespace App\Http\Controllers;

use Tests\Models\User;
use Illuminate\Http\Request;
use App\Models\UserTravelPlans;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function getDetails(Request $request){
        $request->validate([
            'id' => 'required'
        ]);

        $details = User::find($request->id);
        if(!$details) return response()->BaseResponse('404','User not found','');

        return response()->BaseResponse('200','',$details);
    }

    public function login(Request $request){
        $request->validate([
            'username'=>'required',
            'password'=>'required',
            'is_remember'=>'required',
        ]);
    }

    public function register(Request $request){
        $request->validate([
            'username'=>'required',
            'email'=>'required'
        ]);
    }

    public function update(Request $request){
        $request->validate([
            'id' => 'required',
            'name'=>'required',
            'birthday'=>'required',
            'password'=> ['required','confirmed', Password::min(8)->mixedCase()->symbols()],
        ]);

        $user = User::find($request->id);
        $user->name = $request->name;
        $user->birthday = $request->birthday;
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->BaseResponse('200','Update Success','');
    }

    public function getTravelPlanHistory(Request $request){
        $request->validate([
            'user_id' => 'required',
            'num_item' => 'required',
            'page' => 'required',
        ]);

        $skip = $request->num_item  * $request->page;
        $travelModel  = UserTravelPlans::where('user_id',$request->user_id)->with('travelPlan')
        ->with('travelPlan.creator')->skip($skip)->take($request->num_item);
        
        $item = $travelModel->get();
        return response()->BaseResponse('200', '', $item);
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
