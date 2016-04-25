<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AgendaSpeakerTest extends TestCase
{
	use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->signIn();
    }

    public function test_it_adds_speaker_to_the_agenda()
    {
        $agenda = factory(App\Agenda::class)->create([
            'schedule_id' => factory(App\Schedule::class)->create(['description' => ''])->id,
        ]);

        $speaker = factory(App\Speaker::class)->create();

        $response = $this->call('POST', '/dashboard/agendas/'.$agenda->id.'/speaker/'.$speaker->id);

        $this->seeInDatabase('agenda_speakers', [
            'agenda_id'     => $agenda->id,
            'speaker_id'    => $speaker->id
        ]);
    }
    public function test_it_removes_speaker_on_the_agenda()
    {
        $agenda = factory(App\Agenda::class)->create([
            'schedule_id' => factory(App\Schedule::class)->create(['description' => 'test'])->id,
        ]);

        $speaker = factory(App\Speaker::class)->create();
        $agenda->speakers()->attach($speaker->id);

        $response = $this->call('DELETE', '/dashboard/agendas/'.$agenda->id.'/speaker/'.$speaker->id);

        $this->dontSeeInDatabase('agenda_speakers', [
            'agenda_id'     => $agenda->id,
            'speaker_id'    => $speaker->id
        ]);
    }
}
