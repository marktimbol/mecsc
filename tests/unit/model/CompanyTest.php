<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CompanyTest extends TestCase
{
	use DatabaseMigrations;

    public function test_it_shows_all_the_companies()
    {
    	$user = factory(App\User::class)->create();
    	$this->actingAs($user);

    	$company = factory(App\Company::class)->create();

    	$this->visit('/dashboard/companies')
    		->see($company->name);
    }

    public function test_it_show_individual_company()
    {
        $user = factory(App\User::class)->create();
        $this->actingAs($user);

        $company = factory(App\Company::class)->create();

        $this->visit('/dashboard/companies/'.$company->id)
            ->see($company->name);
    }

    public function test_it_stores_a_company_from_an_input_data()
    {
    	$user = factory(App\User::class)->create();
    	$this->actingAs($user);

    	$this->visit('/dashboard/companies')
    		->type('Company Name', 'name')
    		->type('1234', 'standNumber')
    		->type('The Description', 'description')
    		->press('Create Company')

    		->seeInDatabase('companies', [
    			'name'	=> 'Company Name',
    			'standNumber' => '1234',
    			'description' => 'The Description'
    		]);
    }

    public function test_it_validates_input_when_creating_company()
    {
    	$user = factory(App\User::class)->create();
    	$this->actingAs($user);

    	$this->visit('/dashboard/companies')
    		->type('1234', 'standNumber')
    		->type('The Description', 'description')
    		->press('Create Company')

    		->see('The name field is required.');
    }

    public function test_it_shows_an_edit_form_when_editing_company_information()
    {
    	$user = factory(App\User::class)->create();
    	$this->actingAs($user);

    	$company = factory(App\Company::class)->create();

    	$this->visit('/dashboard/companies/'.$company->id.'/edit')
    		->see('Edit Company')
    		->see($company->id);
    }

    public function test_it_updates_a_company_from_an_input_data()
    {
        $user = factory(App\User::class)->create();
        $this->actingAs($user);

        $company = factory(App\Company::class)->create();

        $this->visit('/dashboard/companies/'.$company->id.'/edit')
            ->type('New Company Name', 'name')
            ->type('123', 'standNumber')
            ->type('New Description', 'description')
            ->press('Update Company')

            ->seeInDatabase('companies', [
                'id'    => $company->id,
                'name'  => 'New Company Name',
                'standNumber' => '123',
                'description' => 'New Description'
            ]);
    }


    public function test_it_deletes_a_selected_company()
    {
    	$user = factory(App\User::class)->create();
    	$this->actingAs($user);

    	$company = factory(App\Company::class)->create();

    	$this->call('DELETE', '/dashboard/companies/'.$company->id);

    	$this->dontSeeInDatabase('companies', [
    		'id'	=> $company->id
    	]);
    }
}
