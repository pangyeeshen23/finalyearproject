<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
// use Encore\Admin\Controllers\Dashboard;
use App\Admin\Controllers\Dashboard;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        

        return $content
            ->title('Dashboard')
            ->description('')
            ->row(function (Row $row) {
                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::totalCount());
                });


                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::totalCountTravelPlans());
                });

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::travelPlansType());
                });
                
            })
            ->row(function (Row $row) {
                
                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::ratingCount());
                });

                $row->column(8, function (Column $column) {
                    $column->append(Dashboard::monthlyTravelPlansCount());
                });
            });
    }
}
