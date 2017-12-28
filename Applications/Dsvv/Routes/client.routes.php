<?php
Route::group(['namespace'=>"\Dsvv\Apps\Client\Controllers",'middleware'=>['tracker','widget.builder','dsvv.client']],function(){
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