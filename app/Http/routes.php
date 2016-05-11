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
});

Route::group(['middleware' => 'web'], function () {
	Route::get('/', 'Auth\AuthController@showLoginForm');
    Route::auth();
});
 
Route::group(['prefix' => 'api', 'middleware' => 'auth:api'], function() {
	Route::resource('threads.replies', 'Api\RepliesController', [
		'only' => ['store']
	]);

	Route::get('threads/hasCommunicated/{user}', 'Api\ThreadsController@hasCommunicated');
	Route::resource('threads', 'Api\ThreadsController', [
		'only' => ['index', 'show', 'store']
	]);
});

Route::group(['prefix' => 'api/public'], function() {

	Route::post('login', 'Api\AuthController@getToken');
	Route::resource('schedules', 'Api\SchedulesController', [
		'only' => [
			'index', 'show'
		]
	]);
});
