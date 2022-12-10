<?php

namespace App\Http\Controllers;

use App\Models\TravelPlans;
use Illuminate\Http\Request;

class TravelPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->validate([
            'page' => 'int|required',
            'number_element' => 'int|required'
        ]);

        $offset = $request->page * $request->number_element;

        $items = TravelPlans::
    }

}
