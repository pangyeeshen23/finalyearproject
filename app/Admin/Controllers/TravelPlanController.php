<?php

namespace App\Admin\Controllers;

use App\Models\TravelPlan;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class TravelPlanController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'TravelPlan';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new TravelPlan());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('description', __('Description'));
        $grid->column('meeting_point', __('Meeting point'));
        $grid->column('lat', __('Lat'));
        $grid->column('long', __('Long'));
        $grid->column('fees', __('Fees'));
        $grid->column('is_student', __('Is student'));
        $grid->column('creator_id', __('Creator id'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(TravelPlan::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('description', __('Description'));
        $show->field('meeting_point', __('Meeting point'));
        $show->field('lat', __('Lat'));
        $show->field('long', __('Long'));
        $show->field('fees', __('Fees'));
        $show->field('is_student', __('Is student'));
        $show->field('creator_id', __('Creator id'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new TravelPlan());

        $form->text('name', __('Name'));
        $form->text('description', __('Description'));
        $form->text('meeting_point', __('Meeting point'));
        $form->decimal('lat', __('Lat'));
        $form->decimal('long', __('Long'));
        $form->decimal('fees', __('Fees'));
        $form->switch('is_student', __('Is student'));
        $form->number('creator_id', __('Creator id'));

        return $form;
    }
}
