<?php
namespace $namespace\Providers;

defined('DS') or define('DS', DIRECTORY_SEPARATOR);

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Routing\Router;

use $namespace\Middlewares\Demify;
use $namespace\Middlewares\DemoAdminMiddleware;
use $namespace\Facades\Facade\System;

class DemoServiceProvider extends ServiceProvider
{
	/**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Router $router, Dispatcher $event)
    {
        $this->loadViewsFrom(dirname(__DIR__).'/Views', 'DemoView');
        
        $this->loadTranslationsFrom(dirname(__DIR__).'/Langs', 'DemoLang');

        if (app()->version() >= 5.4) {

            // $router->aliasMiddleware('demo', DemoMiddleware::class);

        } else {

            // $router->middleware('demo',DemoMiddleware::class);

        }
        // this middleware is responsible for initializing the system
        $router->pushMiddlewareToGroup("web", DemoAdminMiddleware::class);
        \App::register(RouteServiceProvider::class);
    }

    public function register()
    {
        $this->loadHelpers();
        $this->loadEvents();
    	\App::bind('Demo', function()
        {
            return new Demo;
        });
    }

    protected function loadHelpers()
    {
        foreach (glob(dirname(__DIR__).'/Helpers/*.php') as $filename) {
            require_once $filename;
        }
    }
    protected function loadEvents()
    {

    }
}
