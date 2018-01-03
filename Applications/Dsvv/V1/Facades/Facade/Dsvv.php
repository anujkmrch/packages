<?php
namespace Dsvv\Facades\Facade;

use Dsvv\Models\User;
use System;

class Dsvv
{

	/**
	 * Gives the model interface for user
	 * @return \Dsvv\Models\User Object Dsvv User Object or null
	 */
	function User()
	{
		if($id = \Auth::id())
			return User::find($id);
		return null;
	}

	/**
	 * 
	 * Simply check if the user is logged in or not
	 * if user is logged in and has valid permission for applying for course
	 * 
	 * @return boolean true/false
	 * 
	 */
	function canIApplyForCourse()
	{
		return !System::isGuestCreated();
	}

	/**
	 * Check if my profile is completed to apply for course
	 * @return [type] [description]
	 */
	function doIhaveValidApplicationProfile()
	{
		System::isGuestCreated();
	}

}