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

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Inertia\Response
     */
    public function edit(Request $request)
    {
        $role = UserRoles::where('id', $request->user()->role_id)->first();
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
            'role' => $role->name,
        ]);
    }

    /**
     * Update the user's profile information.
     *
     * @param  \App\Http\Requests\ProfileUpdateRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileUpdateRequest $request)
    {

        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit');
    }

    /**
     * Delete the user's account.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
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
}
