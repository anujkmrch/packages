<?php
namespace Cloud\Facades;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Facade;
use Cloud\Facades\Facade\Cloud;
class CloudFacade extends Facade{

	/**
     * Get the registered name of the component.
     *
     * @return string
     */

    protected static function getFacadeAccessor() { 
    	return 'Cloud'; 
	}
}
?>