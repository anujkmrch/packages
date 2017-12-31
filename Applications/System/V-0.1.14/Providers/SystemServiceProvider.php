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

        // $this->publishes([
        //     dirname(__DIR__).'/Public/assets' => public_path('systemAssets'),
        // ], 'SystemPublic');
        
        $this->publishes([
           dirname(__DIR__).DS.'Views' => resource_path('views/vendor/SystemView'),
        ]);

        $this->publishes([
        dirname(__DIR__).DS.'Config' => config_path()
    ], 'SystemConfig');

    //     $this->publishes([
    //     dirname(__DIR__).DS.'Migrations' => database_path('migrations')
    // ], 'SystemMigrations');

        if (app()->version() >= 5.4) {

            $router->aliasMiddleware('tracker', SystemTrackerMiddleware::class);

            $router->aliasMiddleware('guest.user', SystemGuestUserMiddleware::class);

            $router->aliasMiddleware('admin.user', SystemAdminMiddleware::class);

            $router->aliasMiddleware('widget.builder', SystemWidgetBuilder::class);

        } else {

            $router->middleware('tracker',SystemTrackerMiddleware::class);

            $router->middleware('guest.user',SystemGuestUserMiddleware::class);

            $router->middleware('admin.user', SystemAdminMiddleware::class);

            $router->middleware('widget.builder', SystemWidgetBuilderMiddleware::class);
        }

        // this middleware is responsible for initializing the system
        $router->pushMiddlewareToGroup("web", SystemGuestUserMiddleware::class);

        $router->pushMiddlewareToGroup("web", SystemAdminBuilderMiddleware::class);

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
#        $this->loadEvents();
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
