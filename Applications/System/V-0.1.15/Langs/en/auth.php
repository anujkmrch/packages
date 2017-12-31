<?php
	return [
		'login' => [
				'title' 	=> 'Please login',
				'description' => "Login to our website",
				'remember_me'	=> 'Remember me',
				'forgot_password'	=> 'Forgot Password?',
				'button_text'		=> 'Log me in',
				'register_text'		=> 'Register',
				'register_link' => 'Don\'t have an account? <a href=":link">Register</a>',
				'label' => ['key' => 'Email/Username','password' => 'Password'],
				'input' => [ 'key' => 'Enter username or email','password'=>'Enter password' ],
			],
			'register' => [
				'title' 	=> 'Create Free Account!!',
				'description' => "Register your account",
				'terms_and_conditions' => 'Accept <a href=":link"> terms and conditions</a>',
				'button_text'		=> 'Sign me up',
				'login_link' => 'Already have an account? <a href=":link">Login</a>',
				'label' => [
							'name' => 'Enter your fullname',
							'username' => 'Enter Username',
							'email' => 'Enter email address',
							'password' => 'Password',
							'password_confirmation' => 'Confirm Password',
							'terms_and_conditions' => 'Accept <a href=":link"> terms and conditions</a>',
							],
				'input' => [ 
							'name' => 'Enter your fullname',
							'username' => 'Enter Username',
							'email' => 'Enter email address',
							'password' => 'Password',
							'password_confirmation' => 'Confirm Password',
							],
			],

			'forgot_password' => [
				'title' 	=> 'Forgot your password?',
				'description' => "We have got your back",
				'terms_and_conditions' => 'Accept <a href=":link"> terms and conditions</a>',
				'button_text'		=> 'Send password link',
				'login_link' => 'Already have an account? <a href=":link">Login</a>',
				'key_label' => 'Username or email address',
				'key_input' => 'Enter Username or email id',
			],

			'reset_password' => [
				'title' 	=> 'Reset your password',
				'description' => "We have got your back",
				'button_text'		=> 'Reset Password',
				'label' => [
							'email' => 'Enter email address',
							'password' => 'Password',
							'password_confirmation' => 'Confirm Password',
							],
				'input' => [ 
							'email' => 'Enter email address',
							'password' => 'Password',
							'password_confirmation' => 'Confirm Password',
							],
			],
	];
?>