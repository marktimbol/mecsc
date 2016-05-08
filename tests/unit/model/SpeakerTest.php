<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Mecsc\Roles\Speaker;

class SpeakerTest extends TestCase
{
	use DatabaseMigrations;

	public function setUp()
	{
		parent::setUp();
		$this->signIn();
	}

	public function test_view_all_speakers()
	{
		$speaker = factory(App\User::class)->create();
		(new Speaker)->add($speaker);

		$this->visit('dashboard/speakers')
			->see('Speakers');
	}

	public function test_it_stores_new_speaker_with_valid_input()
	{
		$this->visit('dashboard/speakers')
			->type('Mark Timbol', 'name')
			->type('mark@timbol.com', 'email')
			->type('IT', 'designation')
			->type('SQ', 'company')
			->type('About Mark', 'about')
			->press('Save')

			->seeInDatabase('users', [
				'name'	=> 'Mark Timbol',
				'email'	=> 'mark@timbol.com',
				'designation'	=> 'IT',
				'company'	=> 'SQ',
				'about'	=> 'About Mark',
			]);
	}

	public function test_it_does_not_store_a_speaker_if_there_is_no_input()
	{
		$this->visit('dashboard/speakers')
			->press('Save')
			->see('The name field is required.');
	}

	public function test_it_shows_update_form_when_editing_speaker()
	{
		$user = factory(App\User::class)->create();

		$this->visit('dashboard/speakers/'.$user->id.'/edit')
			->see($user->name);
	}

	public function test_it_updates_speaker_data()
	{
		$user = factory(App\User::class)->create([
			'designation'	=> 'designer'
		]);

		$this->visit('dashboard/speakers/'.$user->id.'/edit')
			->type('developer', 'designation')
			->type('about me', 'about')
			->press('Update')
			->seeInDatabase('users', [
				'id'	=> $user->id,
				'name'	=> $user->name,
				'email'	=> $user->email,
				'designation'	=> 'developer',
				'company'	=> $user->company,
				'about'	=> 'about me'
			]);
	}

	public function test_it_shows_specific_speaker()
	{
		$this->visit('dashboard/speakers/'.$this->user->id)
			->see($this->user->name);	
	}

	public function test_it_deletes_speaker_by_id()
	{
		$user = factory(App\User::class)->create();
		$response = $this->call('DELETE', 'dashboard/speakers/'.$user->id);

		$this->dontSeeInDatabase('users', [
			'id'	=> $user->id
		]);
	}
}
