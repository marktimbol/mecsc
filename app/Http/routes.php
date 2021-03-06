<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::get('/pusher', function()
{
	// $pusher = new Pusher(
	// 	'a892016947101331c193',
	// 	'23711c1452c32496c02d',
	// 	'207233'
	// );

	// $pusher->trigger('whenUserReplied', 'UserReplied', [
	// 	'data' => 'Hello from Socket.io'
	// ]);
});

Route::group([ 'middleware' => ['web', 'auth'], 'prefix' => 'dashboard'], function() {
	/**
	 * Dashboard
	 */
	Route::get('/', [
		'as' => 'dashboard', 
		'uses' => 'DashboardController@index'
	]);
	
	/**
	 * Users
	 */
	Route::resource('users.roles', 'Dashboard\UserRolesController', [
		'only' => ['store', 'destroy']
	]);
	Route::resource('users', 'Dashboard\UsersController');

	/**
	 * Schedules
	 */
	Route::resource('schedules', 'Dashboard\SchedulesController');

	/**
	 * Speakers
	 */
	Route::resource('speakers', 'Dashboard\SpeakersController');

	/**
	 * Agendas
	 */
	Route::resource('agendas.speakers', 'Dashboard\AgendaSpeakersController', [
		'only' => ['store', 'destroy']
	]);

	Route::resource('agendas', 'Dashboard\AgendasController', [
		'except' => ['create']
	]);

	/**
	 * Companies
	 */
	Route::resource('companies.contacts', 'Dashboard\CompanyContactsController', [
		'only' => ['store', 'destroy']
	]);
	Route::resource('companies.roles', 'Dashboard\CompanyRolesController', [
		'only' => ['store', 'destroy']
	]);
	Route::resource('companies', 'Dashboard\CompaniesController');

	/**
	 * Exhibitors
	 */
	Route::resource('exhibitors', 'Dashboard\ExhibitorsController');

	/**
	 * Media Partners
	 */
	Route::resource('medias', 'Dashboard\MediasController');
});

Route::group(['middleware' => 'web'], function () {
	Route::get('/', 'Auth\AuthController@showLoginForm');
    Route::auth();
});
 
Route::group(['prefix' => 'api', 'middleware' => 'auth:api'], function() {
	Route::get('user/threads', 'Api\UserThreadsController@index');
	Route::get('user/threads/{threads}', 'Api\UserThreadsController@show');	
	Route::resource('threads.replies', 'Api\RepliesController', [
		'only' => ['store']
	]);
	Route::resource('threads', 'Api\ThreadsController', [
		'only' => ['index', 'show', 'store']
	]);
	Route::get('haveConversation/{user1}/{user2}', 'Api\UsersController@haveConversation');
});

Route::group(['prefix' => 'api/public'], function() {
	Route::post('login', 'Api\AuthController@login');
	Route::resource('schedules', 'Api\SchedulesController', [
		'only' => [
			'index', 'show'
		]
	]);
	Route::resource('speakers', 'Api\SpeakersController', [
		'only' => [
			'index', 'show'
		]	
	]);

	Route::get('exhibitors', 'Api\ExhibitorsController@index');
	Route::get('medias', 'Api\MediasController@index');
});
