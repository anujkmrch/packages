<?php
Route::group(['namespace'=>"\Retail\Apps\Client\Controllers",'middleware'=>['tracker','widget.builder']],function(){
		// Route::get('/', [
		// 	'uses' => 'HomeController@index',
		// 	'as'	=> 'client.index',
		// ]);
});
?>