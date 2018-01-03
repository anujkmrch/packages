<?php
namespace Dsvv\Facades;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Facade;
use Dsvv\Facades\Facade\Dsvv;
class DsvvFacade extends Facade{

	/**
     * Get the registered name of the component.
     *
     * @return string
     */

    protected static function getFacadeAccessor() { 
    	return 'Dsvv'; 
	}
}
?>