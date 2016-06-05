<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExhibitorTest extends TestCase
{
	use DatabaseMigrations;

	public function setUp()
	{
		parent::setUp();
		$this->signIn();
	}

    public function test_it_displays_all_the_exhibitors()
    {
    	$exhibitor = factory(App\Exhibitor::class)->create();

    	$this->visit('dashboard/exhibitors')
    		->see($exhibitor->name);
    }

    public function test_it_displays_a_form_when_creating_exhibitor()
    {
    	$this->visit('dashboard/exhibitors')
    		->see('Save');
    }

    public function test_it_stores_user_input_into_exhibitors_table()
    {
    	$this->visit('dashboard/exhibitors')
    		->type('Exhibitor name', 'name')
    		->type('123', 'standNumber')
    		->type('UAE', 'country')
    		->type('http://example.com', 'website')
    		->type('About us', 'about')
    		->press('Save')

    		->seeInDatabase('exhibitors', [
    			'name'	=> 'Exhibitor name',
    			'standNumber'	=> '123',
    			'country'	=> 'UAE',
    			'website'	=> 'http://example.com',
    			'about'	=> 'About us'
    		])

    		->see('Success');
    }

    public function test_it_shows_an_edit_form_when_editing_an_exhibitor()
    {
    	$exhibitor = factory(App\Exhibitor::class)->create();

    	$this->visit('/dashboard/exhibitors/'.$exhibitor->id.'/edit')
    		->see('Update');
    }

    public function test_it_updates_exhibitor_information_when_submitting_a_form()
    {
    	$exhibitor = factory(App\Exhibitor::class)->create();

    	$this->visit('dashboard/exhibitors/'.$exhibitor->id.'/edit')
    		->type('123', 'standNumber')
    		->type('google', 'website')
    		->type('Updated info', 'about')
    		->press('Update')

    		->seeInDatabase('exhibitors', [
    			'id'	=> $exhibitor->id,
    			'name'	=> $exhibitor->name,
    			'standNumber'	=> '123',
    			'country'	=> $exhibitor->country,
    			'website'	=> 'google',
    			'about'	=> 'Updated info'
    		])

    		->see('Success');
    }

    public function test_it_deletes_an_exhibitor()
    {
    	$exhibitor = factory(App\Exhibitor::class)->create();

    	$this->call('DELETE', '/dashboard/exhibitors/'.$exhibitor->id);

    	$this->dontSeeInDatabase('exhibitors', [
			'id' => $exhibitor->id
		]);
    }
}
