<?php

namespace App\Admin\Controllers;

use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\UserRoles;
use Illuminate\Support\Facades\Hash;
use App\Admin\Tools\ApprovalButton;
use Illuminate\Http\Request;
use App\Models\UserStudentApplication;
use Symfony\Component\Debug\Exception;
use Symfony\Component\Debug\Exception\FatalThrowableError;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'User';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User());
        $studentRole = UserRoles::where('slug','STUDENT')->first();

        $grid->column('id', __('Id'));
        $grid->column('username',__('Username'));
        $grid->column('name', __('Name'));
        $grid->column('email', __('Email'));
        $grid->column('email_verified_at', __('Email verified at'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('role', __('Role'))->display(function($role){
            return $role['name'];
        });
        $grid->column('birthday', __('Birthday'));
        $grid->column('studentApplication',__('Student Application'))->display(function() use ($studentRole) {
            if($this->role_id == $studentRole->id) return "<span>Approved</span>";
            else if($this->studentApplication) return "<span>Awaiting approval</span>";
            else return "<span>No Application</span>";
        });

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
        $user = User::where('id',$id)->first();
        $show = new Show(User::findOrFail($id));
        $studentRole = UserRoles::where('slug','STUDENT')->first();

        $show->field('id', __('Id'));
        $show->field('username',__('Username'));
        $show->field('name', __('Name'));
        $show->field('email', __('Email'));
        $show->field('email_verified_at', __('Email verified at'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('birthday', __('Birthday'));

        if($user->role_id != $studentRole->id && $user->studentApplication){
            $studentApplication = $user->studentApplication;
            $show->studentApplication('Student Application', function($studentApplicationInfo) use ($id, $studentApplication){
                $studentApplicationInfo->id();
                $studentApplicationInfo->file_name();
                $studentApplicationInfo->file_link()->image();

                $studentApplicationInfo->panel()->tools(function($tools) use ($id, $studentApplication){
                    $tools->disableEdit();
                    $tools->disableList();
                    $tools->disableDelete();
                    $tools->append(new ApprovalButton($id, $studentApplication->id, "STUDENT"));
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
        $form = new Form(new User());

        $form->text('name', __('Name'));
        $form->text('username',__('Username'));
        $form->email('email', __('Email'));
        $form->datetime('email_verified_at', __('Email verified at'))->default(date('Y-m-d H:i:s'));
        $form->password('password', __('Password'))->default(function($form){
            return $form->model()->password;
        });
        $form->select('role_id', __('Role'))->options(
            UserRoles::all()->pluck("name","id")
        );
        $form->date('birthday', __('Birthday'))->default(date('Y-m-d'));

        $form->saving(function(Form $form){
            if($form->password && $form->model()->password != $form->password) $form->password = Hash::make($form->password);
        });

        return $form;
    }

    public function approval(Request $request){
        $request->validate([
            'user_id' => 'required|int',
            'application_id'=> 'required|int'
        ]);

        $error = false;

        try{
            $userId = $request->user_id;
            $studentApplicationId = $request->student_application_id;
    
            $user = User::where('id',$userId)->first();
    
            // Later on only see do we need the boolean or not for now not sure.
            //$studentApplication = UserStudentApplication::where('id',$studentApplicationId)->first();
    
            $userRole = UserRoles::where('slug','STUDENT')->first();
    
            $user->role_id = $userRole->id;
            $user->update();
        }catch(\Throwable  $ex){
            $error = true;
        }

        if($error) return  admin_toastr('System error, please try again later','error');
        else return admin_toastr('Application approved'); 
    }
}
