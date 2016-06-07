<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MediaPartnerTest extends TestCase
{
	use DatabaseMigrations;

	public function setUp()
	{
		parent::setUp();
		$this->signIn();
	}

    public function test_it_displays_all_the_media_partners()
    {
    	$media = factory(App\Media::class)->create();

    	$this->visit('dashboard/medias')
    		->see($media->name);
    }

    public function test_it_displays_a_form_when_creating_media_partner()
    {
    	$this->visit('dashboard/medias')
    		->see('Save');
    }

    public function test_it_stores_user_input_into_media_partners_table()
    {
    	$this->visit('dashboard/medias')
    		->type('Media partner name', 'name')
    		->type('http://example.com', 'website')
    		->type('About us', 'about')
    		->press('Save')

    		->seeInDatabase('medias', [
    			'name'	=> 'Media partner name',
    			'website'	=> 'http://example.com',
    			'about'	=> 'About us'
    		])

    		->see('Success');
    }

    public function test_it_shows_an_edit_form_when_editing_a_media_partner()
    {
    	$media = factory(App\Media::class)->create();

    	$this->visit('/dashboard/medias/'.$media->id.'/edit')
    		->see('Update');
    }

    public function test_it_updates_media_partner_information_when_submitting_a_form()
    {
    	$media = factory(App\Media::class)->create();

    	$this->visit('dashboard/medias/'.$media->id.'/edit')
    		->type('Updated info', 'about')
    		->press('Update')

    		->seeInDatabase('medias', [
    			'id'	=> $media->id,
    			'name'	=> $media->name,
    			'website'	=> $media->website,
    			'about'	=> 'Updated info'
    		])

    		->see('Success');
    }

    public function test_it_deletes_a_media_partner()
    {
    	$media = factory(App\Media::class)->create();

    	$this->call('DELETE', '/dashboard/medias/'.$media->id);

    	$this->dontSeeInDatabase('medias', [
			'id' => $media->id
		]);
    }
}
