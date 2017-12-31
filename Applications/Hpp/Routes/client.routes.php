<?php
Route::group(['namespace'=>"\Hpp\Apps\Client\Controllers"],function(){
		Route::get('/', [
			'uses' => 'HomeController@index',
			'as'	=> 'client.index',
		]);

		Route::get('/checkout-course-{id}', [
			'uses' => 'CourseController@checkout',
			'as'	=> 'client.course.checkout',
		]);

		Route::get('/course-{id}', [
			'uses' => 'CourseController@course',
			'as'	=> 'client.course.single',
		]);

		Route::get('/courses', [
			'uses' => 'CourseController@courses',
			'as'	=> 'client.course.index',
		]);
});
?>