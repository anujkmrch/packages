<?php
namespace Order\Providers;

defined('DS') or define('DS', DIRECTORY_SEPARATOR);

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Routing\Router;

use Order\Middlewares\OrderAdminMiddleware;
use Order\Middlewares\Orderify;

use Order\Facades\Facade\Order;

class OrderServiceProvider extends ServiceProvider
{
	/**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Router $router, Dispatcher $event)
    {
        $this->loadViewsFrom(dirname(__DIR__).'/Views', 'OrderView');    
        $this->loadTranslationsFrom(dirname(__DIR__).'/Langs', 'OrderLang');

        if (app()->version() >= 5.4) {
            $router->aliasMiddleware('tracker', OrderAdminMiddleware::class);
        } else {
            $router->middleware('tracker',OrderAdminMiddleware::class);
        }
        $router->pushMiddlewareToGroup("web", Orderify::class);
        
        \App::register(RouteServiceProvider::class);
    }

    public function register()
    {
        $this->loadHelpers();
    	\App::bind('Order', function()
        {
            return new Order;
        });
    }

    protected function loadHelpers()
    {
        foreach (glob(dirname(__DIR__).'/Helpers/*.php') as $filename) {
            require_once $filename;
        }
    }
}
