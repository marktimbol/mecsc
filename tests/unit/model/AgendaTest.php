<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AgendaTest extends TestCase
{
	use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->signIn();
    }

	public function test_it_stores_user_input()
	{
		$schedule = factory(App\Schedule::class)->create(['description' => '']);

		$this->visit('/dashboard/agendas')
			->select($schedule->id, 'schedule_id')
			->type('8:00am - 9:00am', 'time')
			->type('Venue', 'venue')
			->type('Title', 'title')
			->type('The description', 'description')
			->press('Create Agenda')
			->seeInDatabase('agendas', [
				'time'			=> '8:00am - 9:00am',
				'venue'			=> 'Venue',
				'title'			=> 'Title',
				'description'	=> 'The description'
			]);
	}

	public function test_do_not_store_inputs_if_the_required_inputs_are_empty()
	{
		$this->visit('/dashboard/agendas')
			->type('Venue', 'venue')
			->type('8:00am - 9:00am', 'time')
			->type('The description', 'description')
			->press('Create Agenda')
			->see('The schedule id field is required')
			->see('The title field is required');
	}

	public function test_show_all_agendas()
	{
		$schedule = factory(App\Schedule::class)->create(['description' => '']);
		$agenda = factory(App\Agenda::class)->make();

		$schedule = $schedule->agendas()->save($agenda);

		$this->visit('dashboard/agendas')
			->see($schedule->date);
	}

	public function test_it_shows_specific_agenda()
	{
		$schedule = factory(App\Schedule::class)->create(['description' => '']);
		$agenda = factory(App\Agenda::class)->make();

		$schedule->agendas()->save($agenda);

		$this->visit('dashboard/agendas/'.$agenda->id)
			->see($agenda->title);
	}

	public function test_it_deletes_agenda_by_id()
	{
		$agenda = factory(App\Agenda::class)->create([]);

		$response = $this->call('DELETE', 'dashboard/agendas/'.$agenda->id, []);

		$this->dontSeeInDatabase('agendas', [
			'id'	=> $agenda->id
		]);
	}
}
