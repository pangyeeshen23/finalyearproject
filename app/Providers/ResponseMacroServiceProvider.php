<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;

class ResponseMacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Response::macro('BaseResponse', function($http_status, $data, $exceptions, $item){
            $response = ['status' => $http_status, 'data'=> $data, 'item' => $item, 'exceptions' => $exceptions];
            return Response::json($response,$http_status);
        });
    }
}
