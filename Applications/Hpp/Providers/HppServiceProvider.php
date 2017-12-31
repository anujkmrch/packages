<?php
namespace Hpp\Providers;

defined('DS') or define('DS', DIRECTORY_SEPARATOR);

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Routing\Router;

use Hpp\Middlewares\HppAdminMiddleware;
use Hpp\Middlewares\HppClientMiddleware;
use Hpp\Middlewares\Hppify;

use Hpp\Facades\Facade\Hpp;

class HppServiceProvider extends ServiceProvider
{
	/**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Router $router, Dispatcher $event)
    {
        $this->loadViewsFrom(dirname(__DIR__).'/Views', 'HppView');    
        $this->loadTranslationsFrom(dirname(__DIR__).'/Langs', 'HppLang');

        $router->pushMiddlewareToGroup("web", Hppify::class);

        //register event subscriber for application with it's namespaces
        \Event::subscribe(\Hpp\Subscribers\Admin\Admin::class);
        \Event::subscribe(\Hpp\Subscribers\Client\Client::class);
        
        \App::register(RouteServiceProvider::class);
    }

    public function register()
    {
        $this->loadHelpers();
    	\App::bind('Hpp', function()
        {
            return new Hpp;
        });
    }

    protected function loadHelpers()
    {
        foreach (glob(dirname(__DIR__).'/Helpers/*.php') as $filename) {
            require_once $filename;
        }
    }
}
