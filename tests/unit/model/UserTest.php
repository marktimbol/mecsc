<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
	use DatabaseMigrations;

	public function setUp()
	{
		parent::setUp();
		$this->signIn();
	}

	public function test_view_all_users()
	{
		$this->visit('dashboard/users')
			->see($this->user->name);
	}

	public function test_it_stores_new_user_with_valid_input()
	{
		$this->visit('dashboard/users')
			->type('Mark Timbol', 'name')
			->type('mark@timbol.com', 'email')
			->type('IT', 'designation')
			->type('SQ', 'company')
			->type('About Mark', 'about')
			->press('Create User')

			->seeInDatabase('users', [
				'name'	=> 'Mark Timbol',
				'email'	=> 'mark@timbol.com',
				'designation'	=> 'IT',
				'company'	=> 'SQ',
				'about'	=> 'About Mark',
			]);
	}

	public function test_it_does_not_store_a_user_if_there_is_no_input()
	{
		$this->visit('dashboard/users')
			->press('Create User')
			->see('The name field is required.');
	}

	public function test_it_shows_update_form_when_editing_user()
	{
		$user = factory(App\User::class)->create();

		$this->visit('dashboard/users/'.$user->id.'/edit')
			->see('Edit User');
	}

	public function test_it_updates_user_data()
	{
		$user = factory(App\User::class)->create([
			'designation'	=> 'designer'
		]);

		$this->visit('dashboard/users/'.$user->id.'/edit')
			->type('developer', 'designation')
			->type('about me', 'about')
			->press('Update User')
			->seeInDatabase('users', [
				'id'	=> $user->id,
				'name'	=> $user->name,
				'email'	=> $user->email,
				'designation'	=> 'developer',
				'company'	=> $user->company,
				'about'	=> 'about me'
			]);
	}

	public function test_it_shows_specific_user()
	{
		$this->visit('dashboard/users/'.$this->user->id)
			->see($this->user->name);	
	}

	public function test_it_deletes_user_by_id()
	{
		$user = factory(App\User::class)->create();
		$response = $this->call('DELETE', 'dashboard/users/'.$user->id);

		$this->dontSeeInDatabase('users', [
			'id'	=> $user->id
		]);
	}
}
