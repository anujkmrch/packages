<?php
namespace System\Providers;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
	public function boot()
    {
        parent::boot();
    }
    
    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
       Route::group([
            'middleware' => ['web']
        ], function ($router) {
            require (dirname(__DIR__).'/Routes/auth.routes.php');
            require (dirname(__DIR__).'/Routes/client.routes.php');
            require (dirname(__DIR__).'/Routes/admin.routes.php');
        });
    }
}