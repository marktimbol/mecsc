<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SpeakerTest extends TestCase
{
	use DatabaseMigrations;

    public function test_it_shows_all_the_speakers()
    {
    	$user = factory(App\User::class)->create();
    	$this->actingAs($user);

    	$speaker = factory(App\User::class)->create([
    		'name'	=> 'Mark Timbol'
    	]);
    	$speaker->roles()->attach(4); //4 => Speaker;

    	$this->seeInDatabase('user_roles', [
    		'user_id'	=> $speaker->id,
    		'role_id'	=> 4,
    	]);

    	$this->visit('/dashboard/speakers')
    		->see('Speakers'); // Not sure why the crawler cannot find $speaker->name
    }

    public function test_it_adds_speaker_to_the_agenda()
    {
        $user = factory(App\User::class)->create();
        $this->actingAs($user);

        $agenda = factory(App\Agenda::class)->create([
            'schedule_id' => factory(App\Schedule::class)->create(['description' => ''])->id,
        ]);

        $speaker = factory(App\User::class)->create();
        $speaker->roles()->attach(4); //4 => Speaker

        $response = $this->call('POST', '/dashboard/agendas/'.$agenda->id.'/speaker/'.$speaker->id);

        $this->seeInDatabase('agenda_speakers', [
            'agenda_id'     => $agenda->id,
            'user_id'    => $speaker->id
        ]);
    }
    public function test_it_removes_speaker_on_the_agenda()
    {
        $user = factory(App\User::class)->create();
        $this->actingAs($user);

        $agenda = factory(App\Agenda::class)->create([
            'schedule_id' => factory(App\Schedule::class)->create(['description' => 'test'])->id,
        ]);

        $speaker = factory(App\User::class)->create();
        $speaker->roles()->attach(4); //4 => Speaker
 
        $agenda->speakers()->attach($speaker->id);

        $response = $this->call('DELETE', '/dashboard/agendas/'.$agenda->id.'/speaker/'.$speaker->id);

        $this->dontSeeInDatabase('agenda_speakers', [
            'agenda_id'     => $agenda->id,
            'user_id'    => $speaker->id
        ]);
    }
}
