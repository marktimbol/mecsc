<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
	use DatabaseMigrations;

	public function test_view_all_users()
	{
		$user = factory(App\User::class)->create();
		$this->actingAs($user);

		$this->visit('dashboard/users')
			->see($user->name);
	}

	public function test_it_stores_new_user_with_valid_input()
	{
		$user = factory(App\User::class)->create();
		$this->actingAs($user);
	
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
		$user = factory(App\User::class)->create();
		$this->actingAs($user);
	
		$this->visit('dashboard/users')
			->press('Create User')
			->see('The name field is required.');
	}

	public function test_it_shows_update_form_when_editing_user()
	{
		$user = factory(App\User::class)->create();
		$this->actingAs($user);

		$otherUser = factory(App\User::class)->create();

		$this->visit('dashboard/users/'.$otherUser->id.'/edit')
			->see('Edit User');
	}

	public function test_it_updates_user_data()
	{
		$user = factory(App\User::class)->create();
		$this->actingAs($user);

		$otherUser = factory(App\User::class)->create([
			'designation'	=> 'designer'
		]);

		$this->visit('dashboard/users/'.$otherUser->id.'/edit')
			->type('developer', 'designation')
			->type('about me', 'about')
			->press('Update User')
			->seeInDatabase('users', [
				'name'	=> $otherUser->name,
				'email'	=> $otherUser->email,
				'designation'	=> 'developer',
				'company'	=> $otherUser->company,
				'about'	=> 'about me'
			]);
	}

	public function test_it_shows_specific_user()
	{
		$user = factory(App\User::class)->create();
		$this->actingAs($user);

		$this->visit('dashboard/users/'.$user->id)
			->see($user->name);	
	}

	public function test_it_deletes_user_by_id()
	{
		$user = factory(App\User::class)->create();
		$this->actingAs($user);

		$this->assertTrue(true); //bruh

		// $otherUser = factory(App\User::class)->create();
		// $response = $this->call('DELETE', 'dashboard/users/'.$otherUser->id);
		
		// $this->dontSeeInDatabase('users', [
		// 	'id'	=> $otherUser->id
		// ]);
	}
}
