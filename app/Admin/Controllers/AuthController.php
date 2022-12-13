<?php

namespace App\Admin\Controllers;

use DateTime;
use Throwable;
use Encore\Admin\Form;
use App\Helper\Helpers;
use App\Models\Drivers;
use Illuminate\Http\Request;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Models\DriverApplications;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\Password;
use Validator;
use Symfony\Component\HttpFoundation\Response;
use Encore\Admin\Controllers\AuthController as BaseAuthController;

class AuthController extends BaseAuthController
{
    /**
     * @var string
     */
    protected $driverLoginView = 'driverLogin';
    protected $driverRegisterView = 'driverRegister';

    /**
     * Show the login page.
     *
     * @return \Illuminate\Contracts\View\Factory|Redirect|\Illuminate\View\View
     */
    public function getDriverLogin()
    {
        if ($this->guard()->check()) {
            return redirect($this->redirectPath());
        }

        return view($this->driverLoginView);
    }

    /**
     * Show the login page.
     *
     * @return \Illuminate\Contracts\View\Factory|Redirect|\Illuminate\View\View
     */
    public function getDriverRegister()
    {
        if ($this->guard()->check()) {
            return redirect($this->redirectPath());
        }

        return view($this->driverRegisterView);
    }

    /**
     * Handle a login request.
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function postDriverLogin(Request $request)
    {
        $this->loginValidator($request->all())->validate();

        $driver = Drivers::where('username', $request->username)->first();

        if($driver && $driver->is_approved != true) return back()->withInput()->withErrors([ $this->username() => 'Please wait to be approved, Thank you']);

        $credentials = $request->only([$this->username(), 'password']);
        $remember = $request->get('remember', false);

        if ($this->guard()->attempt($credentials, $remember)) {
            return $this->sendLoginResponse($request);
        }

        return back()->withInput()->withErrors([
            $this->username() => $this->getFailedLoginMessage(),
        ]);
    }
    
    /**
     * Handle a register function
     * 
     * @param Request $request
     * 
     * @return mixed
     * 
     */

    public function postDriverRegister(Request $request){
        $validator = $this->registerValidator($request->all())->validate();
        
        try{
            $age = Helpers::calculateAgeFromBirthday($request->birthday);

            $driver = new Drivers;
            $driver->username = $request->username;
            $driver->name = $request->name;
            $driver->password = Hash::make($request->password);
            $driver->phone_number = $request->phone_number;
            $driver->email_address = $request->email_address;
            $driver->identity_card_number = $request->ic_number;
            $driver->birthday = $request->birthday;
            $driver->age = $request->age;
            $driver->save();
    
            $driverId = $driver->id;
            $extension = $request->driver_liscense->extension();
            $path = "Driver-Application-$driverId";
            $storedPath = $request->driver_liscense->storeAs('driverApplication', "$path.$extension",'admin');
    
            $driverApplication = new DriverApplications;
            $driverApplication->creator_id = $driverId;
            $driverApplication->file_name = $path;
            $driverApplication->file_link = $storedPath;
            $driverApplication->save();
    
            $roleModel = config('admin.database.roles_model');
            $role = $roleModel::where('slug','driver')->first();
    
            $driver->roles()->attach($role->id);
        }catch(Throwable $exc){
            dd($exc);
            return back()->withInput()->withErrors([ 'state' => 'error' ]);
        }

        return back()->with('state', 'success');
    }

    /**
     * Get a validator for an incoming login request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function registerValidator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|unique:admin_users',
            'name' => 'required',
            'password' => ['required','confirmed', Password::min(8)->mixedCase()->symbols()],
            'email_address' => 'required|email|unique:admin_users',
            'phone_number' => 'required',
            'birthday' => 'required|date',
            'ic_number' => 'required',
            'driver_liscense' => ['required', File::image()]
        ]);
    }

    /**
     * Model-form for driver setting.
     *
     * @return Form
     */
    protected function settingDrvierForm()
    {
        $class = config('admin.database.users_model');

        $form = new Form(new $class());

        $form->display('username', trans('admin.username'));
        $form->text('name', trans('admin.name'))->rules('required');
        $form->image('avatar', trans('admin.avatar'));
        $form->password('password', trans('admin.password'))->rules('confirmed|required');
        $form->password('password_confirmation', trans('admin.password_confirmation'))->rules('required')
            ->default(function ($form) {
                return $form->model()->password;
            });

        $form->setAction(admin_url('auth/setting'));

        $form->ignore(['password_confirmation']);

        $form->saving(function (Form $form) {
            if ($form->password && $form->model()->password != $form->password) {
                $form->password = Hash::make($form->password);
            }
        });

        $form->saved(function () {
            admin_toastr(trans('admin.update_succeeded'));

            return redirect(admin_url('auth/setting'));
        });

        return $form;
    }


}
