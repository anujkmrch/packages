<?php
Route::group(['namespace'=>"\Cloud\Apps\Client\Controllers"],function(){
	Route::group(['middleware'=>['cloud.verify']],function(){
		Route::get('/', [
			'uses' => 'CloudController@index',
			'as'	=> 'client.index',
		]);

		Route::get('/user', [
			'uses' => 'CloudController@index',
			'as'	=> 'client.index',
		]);
	});

	Route::get('/user', [
		'uses' => 'CloudController@index',
		'as'	=> 'client.access.request',
	]);
});
?>