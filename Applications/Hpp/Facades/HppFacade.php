<?php
namespace Hpp\Facades;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Facade;
use Hpp\Facades\Facade\Hpp;
class HppFacade extends Facade{

	/**
     * Get the registered name of the component.
     *
     * @return string
     */

    protected static function getFacadeAccessor() { 
    	return 'Hpp'; 
	}
}
?>