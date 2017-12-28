<?php
namespace $namespace\Facades;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Facade;
use $namespace\Facades\Facade\Demo;
class DemoFacade extends Facade{

	/**
     * Get the registered name of the component.
     *
     * @return string
     */

    protected static function getFacadeAccessor() { 
    	return 'Demo'; 
	}
}
?>