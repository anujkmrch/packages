<?php

namespace System\Subscribers\Auth;

use Subscribers\Login;

class Auth{
	public function subscribe($events)
	{
		$events->listen('auth.onLogin',"\System\Subscribers\Auth\Subscribers\Login@onLogin");

		$events->listen('auth.onRegister',"\System\Subscribers\Auth\Subscribers\Register@onRegister");

		$events->listen('auth.onVerificationFailed',
			"\System\Subscribers\Auth\Subscribers\Verification@onFailed");

		$events->listen('auth.onVerificationSuccessful',
			"\System\Subscribers\Auth\Subscribers\Verification@onSuccessful");
	}
}
?>