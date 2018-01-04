<?php
Route::group(['namespace'=>"\Cloud\Apps\Client\Controllers",'middleware'=>['cloud.verify']],function(){
		Route::get('/', [
			'uses' => 'CloudController@index',
			'as'	=> 'client.index',
		]);

		Route::get('/user', [
			'uses' => 'CloudController@index',
			'as'	=> 'client.index',
		]);

});
?>