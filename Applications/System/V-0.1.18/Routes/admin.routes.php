<?php
Route::group(['prefix'=>'admin','namespace'=>"System\Apps\Admin\Controllers"],function(){
	Route::get('/',[
		'uses' => 'FrontpageController@index',
		'as'   => 'admin.frontpage.index',
	]);

	Route::get('/menus',[
		'uses' => 'MenuController@index',
		'as'   => 'admin.menu.index',
	]);

	Route::get('/test-route',[
		'uses' => 'MenuController@index',
		'as'   => 'admin.route.name',
	]);

	/**
	 * System Controller Routes
	 */
	Route::get('/system',[
		'uses' => 'SystemController@index',
		'as'   => 'admin.system.index',
	]);

	/**
	 * Users Controller Routes
	 */
	Route::get('/users',[
		'uses' => 'UserController@index',
		'as'   => 'admin.user.index',
	]);

	Route::get('/user-search',[
		'uses' => 'UserController@search',
		'as'   => 'admin.user.search',
	]);

	Route::get('/user@{id}',[
		'uses' => 'UserController@single',
		'as'   => 'admin.user.single',
	]);

	Route::post('/user-update@{id}',[
		'uses' => 'UserController@update',
		'as'   => 'admin.user.update',
	]);

	Route::get('/user-create',[
		'uses' => 'UserController@create',
		'as'   => 'admin.user.create',
	]);

	Route::post('/user-create',[
		'uses' => 'UserController@doCreate',
		'as'   => 'admin.user.create',
	]);

	Route::post('/user-delete',[
		'uses' => 'UserController@delete',
		'as'   => 'admin.user.delete',
	]);

	/**
	 * Menu Controller Routes
	 */
	Route::get('/menus',[
		'uses' => 'MenuController@index',
		'as'   => 'admin.menu.index',
	]);

	Route::get('/menus-edit-{type}-item-{id}',[
		'uses' => 'MenuController@item',
		'as'   => 'admin.menu.item',
	]);

	Route::post('/menus-edit-{menu}-item-{id}',[
			'uses' => 'MenuController@doItem',
			'as'   => 'admin.menu.item'
	]);

	Route::get('/menus-trash-{type}-item-{id}',[
		'uses' => 'MenuController@trash',
		'as'   => 'admin.menu.item.trash',
	]);

	Route::get('/menus-trash-{type}-item-{id}',[
		'uses' => 'MenuController@trash',
		'as'   => 'admin.menu.item.trash',
	]);

	Route::get('/trash-menu-{type}',[
		'uses' => 'MenuController@trashMenu',
		'as'   => 'admin.menu.trash',
	]);

	Route::get('/menus-create',[
		'uses' => 'MenuController@createMenu',
		'as'   => 'admin.menu.create',
	]);

	Route::post('/menus-create',[
		'uses' => 'MenuController@doCreateMenu',
		'as'   => 'admin.menu.create',
	]);

	Route::get('/menus-{type}-create-item',[
		'uses' => 'MenuController@createItem',
		'as'   => 'admin.menu.item.create',
	]);

	Route::post('/menus-{type}-create-item',[
		'uses' => 'MenuController@doCreateItem',
		'as'   => 'admin.menu.item.create',
	]);

	Route::get('/menu-{menu}',[
		'uses' => 'MenuController@items',
		'as'   => 'admin.menu.items',
	]);

	/**
	 * Role Controller Routes
	 */
	Route::get('/access',[
		'uses' => 'AccessController@index',
		'as'   => 'admin.access.index',
	]);

	Route::get('/role-trash-{role}',[
		'uses' => 'AccessController@roleTrash',
		'as'   => 'admin.access.trash',
	]);


	Route::get('/permission-trash-{permission}',[
		'uses' => 'AccessController@permissionTrash',
		'as'   => 'admin.permission.trash',
	]);

	Route::get('/role-new',[
		'uses' => 'AccessController@roleCreate',
		'as'   => 'admin.access.create.',
	]);

	Route::post('/role-new',[
		'uses' => 'AccessController@doRoleCreate',
		'as'   => 'admin.access.create.role',
	]);

	Route::post('/permission-new',[
		'uses' => 'AccessController@doPermission',
		'as'   => 'admin.access.create.permission',
	]);

	Route::get('/role-{role}',[
		'uses' => 'AccessController@role',
		'as'   => 'admin.access.role',
	]);

	Route::post('/role-{role}',[
		'uses' => 'AccessController@doRole',
		'as'   => 'admin.access.role',
	]);


	/**
	 * Permission Controller Routes
	 */
	Route::get('/permissions',[
		'uses' => 'PermissionController@index',
		'as'   => 'admin.permission.index',
	]);
	
	/**
	 * Widgets Controller
	 */
	

	Route::get('/widgets',[
		'uses' => 'WidgetController@index',
		'as'   => 'admin.widget.index',
	]);

	Route::get('/widget-create-for-{slug}',[
		'uses' => 'WidgetController@create',
		'as'   => 'admin.widget.create',
	]);

	Route::post('/widget-create-for-{slug}',[
		'uses' => 'WidgetController@doCreate',
		'as'   => 'admin.widget.create',
	]);

	Route::get('/widget-edit-{id}',[
		'uses' => 'WidgetController@edit',
		'as'   => 'admin.widget.edit',
	]);

	Route::post('/widget-edit-{id}',[
		'uses' => 'WidgetController@doEdit',
		'as'   => 'admin.widget.edit',
	]);

	Route::get('/widget-assing-{id}',[
		'uses' => 'WidgetController@assign',
		'as'   => 'admin.widget.assign',
	]);

	Route::get('/widget-unassign',[
		'uses' => 'WidgetController@index',
		'as'   => 'admin.widget.unassign',
	]);

	Route::get('/extend-widget-all',[
		'uses' => 'WidgetController@widgets',
		'as'   => 'admin.widget.list',
	]);
});
?>
