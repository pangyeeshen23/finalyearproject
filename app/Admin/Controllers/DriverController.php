<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\Drivers;
use Illuminate\Http\Request;
use App\Admin\Tools\ApprovalButton;
use Illuminate\Support\Facades\Hash;
use Encore\Admin\Controllers\AdminController;

class DriverController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Drivers';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Drivers());

        $grid->model()->whereHas('roles', function ($query) {
            $query->where('slug', 'driver');
        });

        $grid->column('id', __('Id'));
        $grid->column('username', __('Username'));
        $grid->column('name', __('Name'));
        $grid->column('email_address', __('Email Address'));
        $grid->column('phone_number', __('Phone Number'));
        $grid->column('identity_card_number', __('Identity Card Number'));
        $grid->column('age', __('Age'));
        $grid->column('birthday', __('Birthday'));
        $grid->column('is_approved', __('Is Approved'))->bool();
        $grid->column('roles', 'Roles')->pluck('name')->label();
        $grid->column('created_at', __('Created At'));
        $grid->column('updated_at', __('Updated At'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $driver = Drivers::findOrFail($id);
        $show = new Show($driver);

        $show->field('id', __('Id'));
        $show->field('username', __('Username'));
        $show->field('name', __('Name'));
        $show->field('avatar', __('Avatar'))->image();
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('email_address', __('Email address'));
        $show->field('phone_number', __('Phone number'));
        $show->field('identity_card_number', __('Identity card number'));
        $show->field('age', __('Age'));
        $show->field('birthday', __('Birthday'));
        $show->field('is_approved', __('Is approved'))->using([0 => "No", 1 => "Yes"]);

        $show->field('roles', 'Roles')->as(function ($roles) {
            return $roles->pluck('name');
        })->label();
        
        if($driver->driverApplication){
            $driverApplication = $driver->driverApplication;
            $show->driverApplication('Driver Application', function($driverApplicationInfo) use ($id, $driverApplication){
                $driverApplication->id();
                $driverApplication->file_name();
                $driverApplication->file_image()->image();

                $driverApplication->panel()->tools(function($tool) use ($id, $driverApplication){
                    $tool->disableEdit();
                    $tool->disableList();
                    $tool->disableDelet();
                    $tool->append(new ApprovalButton($id, $driverApplication->id, "DRIVER"));
                });
            });
        }
        

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        
        $permissionModel = config('admin.database.permissions_model');
        $roleModel = config('admin.database.roles_model');
        $driverRole = $roleModel::where('slug','driver')->first();
        
        $form = new Form(new Drivers());

        $form->text('username', __('Username'))->required()
            ->creationRules('unique:admin_users')
            ->updateRules('unique:admin_users,username,{{id}}');
        $form->password('password', __('Password'))->required()->default(function($form){
            return $form->model()->password;
        });
        $form->text('name', __('Name'))->required();
        $form->image('avatar', __('Avatar'))->required();
        $form->text('email_address', __('Email address'))->required()->rules('email');
        $form->text('phone_number', __('Phone number'))->required();
        $form->text('identity_card_number', __('Identity card number'))->required();
        $form->text('age', __('Age'))->required();
        $form->date('birthday', __('Birthday'))->default(date('Y-m-d'))->required();
        $form->switch('is_approved', __('Is approved'));
        $form->multipleSelect('roles', trans('admin.roles'))
        ->options($roleModel::all()->pluck('name', 'id'))
        ->default($driverRole->id)
        ->readonly()->required();

        $form->saving(function(Form $form){
            if($form->password && $form->model()->password != $form->password) $form->password = Hash::make($form->password);
        });



        return $form;
    }

    public function approval(Request $request){
        // havent test
        $request->validate([
            'user_id' => 'required|int',
            'application_id'=> 'required|int'
        ]);

        $error = false;

        try{

            $driver = Driver::findorfail($request->id);
            $driver->is_approved = true;
            $driver->update();

        }catch(\Throwable $ex){
            $error = true;
        }

        if($error) return  admin_toastr("System error, Please try again later", "error");
        else return admin_toastr("Application Approved");

    }
}
