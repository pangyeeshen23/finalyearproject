<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\UserRoles;
use Illuminate\Http\Request;
use App\Models\UserTravelPlans;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\TravelPlans;

class DashboardController extends Controller
{
    /**
     * Display the user's profile form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        $userId = $request->user()->id;

        $historyTravelPlans = UserTravelPlans::where('user_id', $userId)->with('travelPlan')->get();
        $travelPlanCount = UserTravelPlans::where('user_id', $userId)->count();
        $rateGivenCount = UserTravelPlans::where('user_id', $userId)
        ->where('rate','!=',null)->count();
        $totalSpending = $historyTravelPlans->sum('travelPlan.fees');

        return Inertia::render('Dashboard', [
            'totalPlanCount' => $travelPlanCount,
            'rateGivenCount' => $rateGivenCount,
            'totalSpending' => $totalSpending,
            'historyTravelPlans' => $historyTravelPlans,
        ]);
    }
}
