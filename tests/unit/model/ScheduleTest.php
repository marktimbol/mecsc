<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ScheduleTest extends TestCase
{
	use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->signIn();
    }

	public function test_view_all_schedules()
	{
		$schedule = factory(App\Schedule::class)->create(['description'	=> '']);

		$this->visit('dashboard/schedules')
			->see($schedule->date);
	}

	public function test_it_stores_a_schedule_with_correct_input()
	{
		$this->visit('dashboard/schedules')
			->type('1975-12-25 14:15:16', 'eventDate')
			->type('The description', 'description')
			->press('Create Schedule')

			->seeInDatabase('schedules', [
				'eventDate'	=> '1975-12-25 14:15:16',
				'description'	=> 'The description'
			]);
	}

	public function test_it_does_not_stores_a_schedule_if_there_is_no_input_date()
	{
		$this->visit('dashboard/schedules')
			->press('Create Schedule')
			->see('The event date field is required.');
	}

	public function test_it_deletes_schedule_by_id()
	{
		$schedule = factory(App\Schedule::class)->create(['description'	=> 'test']);

		$response = $this->call('DELETE', 'dashboard/schedules/'.$schedule->id, []);
		
		$this->dontSeeInDatabase('schedules', [
			'id'	=> $schedule->id
		]);
	}
}
