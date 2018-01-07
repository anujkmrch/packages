<?php
namespace System\Providers;

defined('DS') or define('DS', DIRECTORY_SEPARATOR);

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Routing\Router;

use System\Middlewares\SystemTrackerMiddleware;
use System\Middlewares\SystemGuestUserMiddleware;
use System\Middlewares\SystemApiGuestUserMiddleware;
use System\Middlewares\SystemWidgetBuilderMiddleware;
use System\Middlewares\SystemAdminMiddleware;
use System\Middlewares\SystemAdminBuilderMiddleware;

use System\Middlewares\Guestify;
use System\Facades\Facade\System;
use System\Facades\Facade\Admin;

use File;

class SystemServiceProvider extends ServiceProvider
{
	/**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Router $router, Dispatcher $event)
    {
        $this->loadViewsFrom(dirname(__DIR__).'/Views', 'SystemView');
        
        $this->loadTranslationsFrom(dirname(__DIR__).'/Langs', 'SystemLang');
        
        $this->publishes([
           dirname(__DIR__).DS.'Views' => resource_path('views/vendor/SystemView'),
        ]);

        $this->publishes([
            dirname(__DIR__).DS.'Config' => config_path()
        ], 'SystemConfig');


        if (app()->version() >= 5.4) {
            $router->aliasMiddleware('jwt.auth', 'Tymon\JWTAuth\Middleware\GetUserFromToken');
            $router->aliasMiddleware('jwt.refresh', 'Tymon\JWTAuth\Middleware\RefreshToken');
        } else {
            $router->middleware('jwt.auth', 'Tymon\JWTAuth\Middleware\GetUserFromToken');
            $router->middleware('jwt.refresh', 'Tymon\JWTAuth\Middleware\RefreshToken');
        }

        // this middleware is responsible for initializing the system
        $router->pushMiddlewareToGroup("web",SystemGuestUserMiddleware::class);

        $router->pushMiddlewareToGroup("api",SystemApiGuestUserMiddleware::class);

        $router->pushMiddlewareToGroup("web",SystemAdminMiddleware::class);

        $router->pushMiddlewareToGroup("web",SystemTrackerMiddleware::class);

        $router->pushMiddlewareToGroup("web",SystemAdminBuilderMiddleware::class);

        $router->pushMiddlewareToGroup("web",SystemWidgetBuilderMiddleware::class);


        //register application routes
        \App::register(RouteServiceProvider::class);
        

        //register event subscriber for application with it's namespaces
        \Event::subscribe(\System\Subscribers\Auth\Auth::class);
        \Event::subscribe(\System\Subscribers\Admin\Admin::class);
        \Event::subscribe(\System\Subscribers\Api\Api::class);
        \Event::subscribe(\System\Subscribers\Client\Client::class);
        
    }

    public function register()
    {
        // $app->register(Vendor\Package\TestServiceProvider::class);
        $this->loadHelpers();
        $this->loadWidgetCallback();


        $this->commands([
            \System\Commands\AssignSystemAdmin::class,
            \System\Commands\CreateSystemAdmin::class,
            \System\Commands\InstallSystem::class,
        ]);

    	\App::bind('System', function()
        {
            return new System;
        });

        \App::bind('Admin', function()
        {
            return new Admin;
        });

        
    }

    protected function loadHelpers()
    {
        foreach (glob(dirname(__DIR__).'/Helpers/*.php') as $filename) {
            require_once $filename;
        }
    }

    protected function loadWidgetCallback()
    {
        foreach (glob(dirname(__DIR__).'/Widget_Callbacks/*.php') as $filename) {
            require_once $filename;
        }
    }
}
