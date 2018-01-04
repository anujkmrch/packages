<?php
namespace Cloud\Providers;

defined('DS') or define('DS', DIRECTORY_SEPARATOR);

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Routing\Router;

use Cloud\Middlewares\Cloudify;
use Cloud\Middlewares\CloudAuthenticate;

use Cloud\Facades\Facade\Cloud;

class CloudServiceProvider extends ServiceProvider
{
	/**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Router $router, Dispatcher $event)
    {
        $this->loadViewsFrom(dirname(__DIR__).'/Views', 'CloudView');    
        $this->loadTranslationsFrom(dirname(__DIR__).'/Langs', 'CloudLang');

        //It's time to push the Cloud model to web middleware so it will be accessible to every one
        $router->pushMiddlewareToGroup("web", Cloudify::class);

         if (app()->version() >= 5.4) {
            $router->aliasMiddleware('cloud.verify', CloudAuthenticate::class);
        } else {
            $router->middleware('cloud.verify',CloudAuthenticate::class);
        }

        //register event subscriber for application with it's namespaces

        \Event::subscribe(\Cloud\Subscribers\Admin\Admin::class);
        \Event::subscribe(\Cloud\Subscribers\Client\Client::class);

        \App::register(RouteServiceProvider::class);
    }

    public function register()
    {
        $this->loadHelpers();
    	\App::bind('Cloud', function()
        {
            return new Cloud;
        });
    }

    protected function loadHelpers()
    {
        foreach (glob(dirname(__DIR__).'/Helpers/*.php') as $filename) {
            require_once $filename;
        }
    }
}
