<?php
namespace Service\Providers;

defined('DS') or define('DS', DIRECTORY_SEPARATOR);

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Routing\Router;

use Service\Middlewares\OrderAdminMiddleware;
use Service\Middlewares\Servicify;

use Service\Facades\Facade\Service;


class ServiceServiceProvider extends ServiceProvider
{
	/**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Router $router, Dispatcher $event)
    {
        $this->loadViewsFrom(dirname(__DIR__).'/Views', 'ServiceView');    
        $this->loadTranslationsFrom(dirname(__DIR__).'/Langs', 'ServiceLang');

        if (app()->version() >= 5.4) {
            $router->aliasMiddleware('tracker', ServiceAdminMiddleware::class);
        } else {
            $router->middleware('tracker',ServiceAdminMiddleware::class);
        }
        $router->pushMiddlewareToGroup("web", Servicify::class);
        
        \App::register(RouteServiceProvider::class);

    }

    public function register()
    {
        $this->loadHelpers();

    	\App::bind('Service', function()
        {
            return new Service;
        });
    }

    protected function loadHelpers()
    {
        foreach (glob(dirname(__DIR__).'/Helpers/*.php') as $filename) {
            require_once $filename;
        }
    }
}
