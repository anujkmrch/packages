<?php
Route::group(['middleware'=>['admin.user'],'prefix'=>'admin','namespace'=>"Service\Apps\Admin\Controllers"],function(){
	Route::get('/',[
		'uses' => 'FrontpageController@index',
		'as'   => 'admin.frontpage.index',
	]);

	
});
?>
