<?php
Route::group(['prefix'=>'admin/cloud','namespace'=>"Cloud\Apps\Admin\Controllers"],function(){
	Route::get('/',[
		'uses' => 'CloudController@index',
		'as'   => 'cloud.admin.index',
	]);
	/**
	 * Application Controller Routes
	 */
	Route::get('files',[
		'uses' => 'CloudController@index',
		'as'   => 'cloud.admin.files',
	]);

	Route::get('user-{id}-files',[
		'uses' => 'CloudController@user',
		'as'   => 'cloud.admin.user.single',
	]);

	Route::get('users',[
		'uses' => 'CloudController@users',
		'as'   => 'cloud.admin.users',
	]);

});
?>
