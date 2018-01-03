<?php
Route::group(['namespace'=>"\System\Apps\Client\Controllers"],function(){

		Route::get('/', [
			'uses' => 'HomeController@index',
			'as'	=> 'client.index',
		]);

		Route::get('/account', [
			'uses' => 'UserController@account',
			'as'	=> 'client.user.account',
		]);

		Route::post('/profile', [
			'uses' => 'UserController@updateProfile',
			'as'	=> 'client.user.profile.update',
		]);

		Route::get('/profile', [
			'uses' => 'UserController@profile',
			'as'	=> 'client.user.profile',
		]);
});
?>