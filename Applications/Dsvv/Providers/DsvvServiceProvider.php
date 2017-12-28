<?php
namespace Dsvv\Providers;

defined('DS') or define('DS', DIRECTORY_SEPARATOR);

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Routing\Router;

use Dsvv\Middlewares\DsvvAdminMiddleware;
use Dsvv\Middlewares\DsvvClientMiddleware;
use Dsvv\Middlewares\Dsvvify;

use Dsvv\Facades\Facade\Dsvv;

class DsvvServiceProvider extends ServiceProvider
{
	/**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Router $router, Dispatcher $event)
    {
        $this->loadViewsFrom(dirname(__DIR__).'/Views', 'DsvvView');    
        $this->loadTranslationsFrom(dirname(__DIR__).'/Langs', 'DsvvLang');

        if (app()->version() >= 5.4) {
            $router->aliasMiddleware('tracker', DsvvAdminMiddleware::class);
            $router->aliasMiddleware('dsvv.client', DsvvClientMiddleware::class);
        } else {
            $router->middleware('tracker',DsvvAdminMiddleware::class);
            $router->middleware('dsvv.client',DsvvClientMiddleware::class);
        }

        $router->pushMiddlewareToGroup("web", Dsvvify::class);


        //register event subscriber for application with it's namespaces
        \Event::subscribe(\Dsvv\Subscribers\Admin\Admin::class);
        \Event::subscribe(\Dsvv\Subscribers\Client\Client::class);
        
        \App::register(RouteServiceProvider::class);
    }

    public function register()
    {
        $this->loadHelpers();
    	\App::bind('Dsvv', function()
        {
            return new Dsvv;
        });
    }

    protected function loadHelpers()
    {
        foreach (glob(dirname(__DIR__).'/Helpers/*.php') as $filename) {
            require_once $filename;
        }
    }
}
