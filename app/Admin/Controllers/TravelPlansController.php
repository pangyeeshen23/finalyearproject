<?php

namespace App\Admin\Controllers;

use App\Models\TravelPlans;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Facades\Admin;

class TravelPlansController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Travel Plans';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {

        $grid = new Grid(new TravelPlans());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('description', __('Description'));
        $grid->column('meeting_point', __('Meeting point'));
        $grid->column('fees', __('Fees'));
        $grid->column('is_student', __('Is student'))->bool();
        $grid->column('creator_id', __('Creator id'))->display(function($adminId){
            $adminModel = config('admin.database.users_model');
            return  $adminModel::find($adminId)->name;
        });
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
        $show = new Show(TravelPlans::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('description', __('Description'));
        $show->field('meeting_point', __('Meeting point'));
        $show->field('depart', __('Depart'))->latlong('depart_lat', 'depart_long', $height = 400, $zoom = 10);
        $show->field('destination', __('Destination'))->latlong('destination_lat', 'destination_long', $height = 400, $zoom = 10);
        $show->field('fees', __('Fees'));
        $show->field('is_student', __('For student only ?'));
        $show->admins('Creator Information', function($creator){
            $creator->id();
            $creator->name();
        });
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
        $form = new Form(new TravelPlans());
        $form->text('name', __('Name'))->required();
        $form->text('description', __('Description'))->required();
        $form->text('meeting_point', __('Meeting point'))->required();
        $form->latlong('depart_lat', 'depart_long', 'Depart')->default(['lat' => 3.1569, 'lng' => 101.7123])->required();
        $form->latlong('destination_lat', 'destination_long', 'Destination')->default(['lat' => 3.1569, 'lng' => 101.7123])->required();
        $form->decimal('fees', __('Fees/Person'))->required();
        $form->number('num_passengers', __('Number of Passenger'))->required();
        $form->switch('is_student', __('Only Allow Student ?'));
        $form->hidden('creator_id', __('Name'))->default(Admin::user()->id);

        return $form;
    }
}
