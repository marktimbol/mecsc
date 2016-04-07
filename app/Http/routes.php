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
	Route::get('/', [
		'as' => 'dashboard', 
		'uses' => 'DashboardController@index'
	]);
	
	Route::resource('users.roles', 'Dashboard\UserRolesController', ['only' => ['store', 'destroy']]);
	Route::get('speakers', [
		'as' => 'dashboard.speakers.index', 
		'uses' => 'Dashboard\SpeakersController@index'
	]);
	Route::resource('users', 'Dashboard\UsersController');

	Route::resource('schedules', 'Dashboard\SchedulesController');

	Route::post('agendas/{agendas}/speaker/{speaker}', [
		'as' => 'speaker.add', 
		'uses' => 'Dashboard\AgendasController@addSpeaker'
	]);

	Route::delete('agendas/{agendas}/speaker/{speaker}', [
		'as' => 'speaker.remove', 
		'uses' => 'Dashboard\AgendasController@removeSpeaker'
	]);

	Route::resource('agendas', 'Dashboard\AgendasController', [
		'except' => ['create']
	]);

	Route::resource('companies.roles', 'Dashboard\CompanyRolesController', ['only' => ['store', 'destroy']]);
	Route::resource('companies', 'Dashboard\CompaniesController');
});

Route::group(['middleware' => 'web'], function () {
	Route::get('/', 'Auth\AuthController@showLoginForm');
    Route::auth();
});
