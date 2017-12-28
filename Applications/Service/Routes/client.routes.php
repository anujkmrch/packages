<?php
Route::group(['namespace'=>"\System\Apps\Client\Controllers",'middleware'=>['tracker','widget.builder']],function(){
	
		// Route::get('/', [
		// 	'uses' => 'HomeController@index',
		// 	'as'	=> 'client.index',
		// ]);
});
?>