<?php

namespace App\Admin\Controllers;

use Encore\Admin\Layout\Row;
// use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use App\Admin\Controllers\Dashboard;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        

        return $content
            ->title('Dashboard')
            ->description('')
            ->row(function (Row $row) {

                if(Admin::user()->isRole('administrator')){
                    $row->column(4, function (Column $column) {
                        $column->append(Dashboard::totalCount());
                    });
                }

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::totalCountTravelPlans());
                });

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::travelPlansType());
                });

                if(Admin::user()->isRole('driver')){
                    $row->column(4, function (Column $column) {
                        $column->append(Dashboard::driverRating());
                    });
                }
                
            })
            ->row(function (Row $row) {
                
                if(Admin::user()->isRole('administrator')){
                    $row->column(4, function (Column $column) {
                        $column->append(Dashboard::ratingCount());
                    });
                }

                $row->column(8, function (Column $column) {
                    $column->append(Dashboard::monthlyTravelPlansCount());
                });
            });
    }
}
