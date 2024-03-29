<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Inertia\Inertia;
use App\Models\UserRoles;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Models\UserStudentApplications;
use App\Providers\RouteServiceProvider;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:'.User::class,
            'birthday' => 'required|date',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'register_as_student' => 'required',
            'student_application' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $defaultRole = UserRoles::where('slug','DEFAULT')->first();

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'birthday' => $request->birthday,
            'role_id' => $defaultRole->id,
        ]);

        if($request->register_as_student && $request->hasFile('student_application')){
            $studentId = $user->id;
            $extension = $request->student_application->extension();
            $path = "Student-Application-$studentId";
            $storedPath = $request->student_application->storeAs('studentApplication', "$path.$extension",'admin');
    
            $userStudentApplication = new UserStudentApplications;
            $userStudentApplication->user_id = $studentId;
            $userStudentApplication->file_name = $path;
            $userStudentApplication->file_link = $storedPath;
            $userStudentApplication->save();
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
