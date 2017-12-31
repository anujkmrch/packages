<?php
Route::group('prefix'=>'admin','namespace'=>"Dsvv\Apps\Admin\Controllers"],function(){

	/**
	 * Application Controller Routes
	 */
	Route::get('/applications',[
		'uses' => 'ApplicationController@index',
		'as'   => 'admin.application.index',
	]);

	Route::get('/verify-application-{id}',[
		'uses' => 'ApplicationController@verify',
		'as'   => 'admin.application.verify',
	]);

	Route::get('/applications-new',[
		'uses' => 'ApplicationController@newOnly',
		'as'   => 'admin.application.newonly',
	]);

	Route::get('/applications-verified',[
		'uses' => 'ApplicationController@verifiedOnly',
		'as'   => 'admin.application.verifiedonly',
	]);

	Route::get('/applications-rejected',[
		'uses' => 'ApplicationController@rejectedOnly',
		'as'   => 'admin.application.rejectedonly',
	]);





	/**
	 * Course Controller Routes
	 */
	Route::get('/courses',[
		'uses' => 'CourseController@index',
		'as'   => 'admin.course.index',
	]);

	/**
	 * Dbsync Controller Routes
	 */
	Route::get('/oracle-mysql-db-sync',[
		'uses' => 'DbsyncController@index',
		'as'   => 'admin.dbsync.index',
	]);
	
});
?>
