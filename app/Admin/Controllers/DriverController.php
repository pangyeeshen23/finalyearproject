<?php

namespace App\Admin\Controllers;

use App\Models\Drivers;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

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
        $grid->column('password', __('Password'));
        $grid->column('name', __('Name'));
        $grid->column('avatar', __('Avatar'));
        $grid->column('remember_token', __('Remember Token'));
        $grid->column('created_at', __('Created At'));
        $grid->column('updated_at', __('Updated At'));
        $grid->column('email_address', __('Email Address'));
        $grid->column('phone_number', __('Phone Number'));
        $grid->column('identity_card_number', __('Identity Card Number'));
        $grid->column('age', __('Age'));
        $grid->column('birthday', __('Birthday'));
        $grid->column('is_approved', __('Is Approved'))->bool();

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
        $show = new Show(Drivers::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('username', __('Username'));
        $show->field('password', __('Password'));
        $show->field('name', __('Name'));
        $show->field('avatar', __('Avatar'));
        $show->field('remember_token', __('Remember token'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('email_address', __('Email address'));
        $show->field('phone_number', __('Phone number'));
        $show->field('identity_card_number', __('Identity card number'));
        $show->field('age', __('Age'));
        $show->field('birthday', __('Birthday'));
        $show->field('is_approved', __('Is approved'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Drivers());

        $form->text('username', __('Username'));
        $form->password('password', __('Password'));
        $form->text('name', __('Name'));
        $form->image('avatar', __('Avatar'));
        $form->text('remember_token', __('Remember token'));
        $form->text('email_address', __('Email address'));
        $form->text('phone_number', __('Phone number'));
        $form->text('identity_card_number', __('Identity card number'));
        $form->text('age', __('Age'));
        $form->date('birthday', __('Birthday'))->default(date('Y-m-d'));
        $form->switch('is_approved', __('Is approved'));

        return $form;
    }
}
