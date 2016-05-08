<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SpeakerTest extends TestCase
{
	use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->signIn();
    }

    public function test_it_shows_all_the_speakers()
    {
    	$speaker = factory(App\Speaker::class)->create([
    		'name'	=> 'Mark Timbol'
    	]);

    	$this->seeInDatabase('speakers', [
            'id'   => $speaker->id,
            'name'  => $speaker->name,
    	]);
    }

    public function test_it_stores_new_speaker_with_valid_input()
    {
        $this->visit('dashboard/speakers')
            ->type('Speaker Name', 'name')
            ->type('His designation', 'designation')
            ->type('Where does he work?', 'company')
            ->type('About this Muggle', 'about')
            ->press('Create Speaker')

            ->seeInDatabase('speakers', [
                'name'  => 'Speaker Name',
                'designation'   => 'His designation',
                'company'   => 'Where does he work?',
                'about' => 'About this Muggle',
            ]);
    }

    public function test_it_does_not_store_a_speaker_if_there_is_no_input()
    {
        $this->visit('dashboard/speakers')
            ->press('Create Speaker')
            ->see('The name field is required.');
    }

    public function test_it_shows_update_form_when_editing_speaker()
    {
        $speaker = factory(App\User::class)->create();

        $this->visit('dashboard/speakers/'.$speaker->id.'/edit')
            ->see('Edit Speaker');
    }

    public function test_it_updates_speaker_data()
    {
        $speaker = factory(App\User::class)->create();

        $this->visit('dashboard/speakers/'.$speaker->id.'/edit')
            ->type('Web Developer', 'designation')
            ->press('Update Speaker')

            ->seeInDatabase('speakers', [
                'id'    => $speaker->id,
                'designation'   => 'Web Developer',
            ]);
    }

    public function test_it_shows_specific_speaker()
    {
        $speaker = factory(App\User::class)->create();
        $this->visit('dashboard/speakers/'.$speaker->id)
            ->see($speaker->name); 
    }

    public function test_it_deletes_speaker_by_id()
    {
        $speaker = factory(App\User::class)->create();
        $response = $this->call('DELETE', 'dashboard/speakers/'.$speaker->id);

        $this->dontSeeInDatabase('speakers', [
         'id'    => $speaker->id
        ]);
    }
}
