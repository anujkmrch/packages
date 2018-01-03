<?php
Route::group(['prefix'=>'admin/university','namespace'=>"Dsvv\Apps\Admin\Controllers"],function(){
	Route::get('/',[
		'uses' => 'ApplicationController@index',
		'as'   => 'dsvv.admin.index',
	]);
	/**
	 * Application Controller Routes
	 */
	Route::get('applications',[
		'uses' => 'ApplicationController@index',
		'as'   => 'dsvv.admin.application.index',
	]);

	Route::get('verify-application-{id}',[
		'uses' => 'ApplicationController@verify',
		'as'   => 'dsvv.admin.application.verify',
	]);

	Route::get('new-application',[
		'uses' => 'ApplicationController@newOnly',
		'as'   => 'dsvv.admin.application.newonly',
	]);

	Route::get('/applications-verified',[
		'uses' => 'ApplicationController@verifiedOnly',
		'as'   => 'dsvv.admin.application.verifiedonly',
	]);

	Route::get('/applications-rejected',[
		'uses' => 'ApplicationController@rejectedOnly',
		'as'   => 'dsvv.admin.application.rejectedonly',
	]);

	/**
	 * Course Controller Routes
	 */
	Route::get('/courses',[
		'uses' => 'CourseController@index',
		'as'   => 'dsvv.admin.course.index',
	]);

	Route::get('/course-create-new',[
		'uses' => 'CourseController@create',
		'as'   => 'dsvv.admin.course.create',
	]);

	Route::post('/course-create-new',[
		'uses' => 'CourseController@doCreate',
		'as'   => 'dsvv.admin.course.create',
	]);

	Route::get('/course-{code}',[
		'uses' => 'CourseController@single',
		'as'   => 'dsvv.admin.course.single',
	]);

	Route::post('/course-{code}',[
		'uses' => 'CourseController@doSingle',
		'as'   => 'dsvv.admin.course.single',
	]);

	

	/**
	 * Session Controller Routes
	 */
	Route::get('/sessions',[
		'uses' => 'SessionController@index',
		'as'   => 'dsvv.admin.session.index',
	]);

	Route::get('/session-create-new',[
		'uses' => 'SessionController@create',
		'as'   => 'dsvv.admin.session.create',
	]);

	Route::post('/session-create-new',[
		'uses' => 'SessionController@doCreate',
		'as'   => 'dsvv.admin.session.create',
	]);

	Route::get('/session-{id}',[
		'uses' => 'SessionController@single',
		'as'   => 'dsvv.admin.session.single',
	]);

	Route::post('/session-{id}',[
		'uses' => 'SessionController@doSingle',
		'as'   => 'dsvv.admin.session.single',
	]);

	/**
	 * Applicant Controller Routes
	 */
	Route::get('/applicants',[
		'uses' => 'CourseController@index',
		'as'   => 'dsvv.admin.applicant.index',
	]);

	/**
	 * Dbsync Controller Routes
	 */
	Route::get('/oracle-mysql-db-sync',[
		'uses' => 'DbsyncController@index',
		'as'   => 'dsvv.admin.dbsync.index',
	]);
	
});
?>
