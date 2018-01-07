<?php
namespace System\Facades;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Facade;
use System\Facades\Facade\System;
class SystemFacade extends Facade{

	/**
     * Get the registered name of the component.
     *
     * @return string
     */

    protected static function getFacadeAccessor() { 
    	return 'System'; 
	}
}
?>