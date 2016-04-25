<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CompanyContactsTest extends TestCase
{
	use DatabaseMigrations;

	public function setUp()
	{
		parent::setUp();
		$this->signIn();
	}

    public function test_it_adds_a_contact_to_the_company()
    {
    	$company = factory(App\Company::class)->create();
    	$contact = factory(App\User::class)->create();

    	$response = $this->call('POST', '/dashboard/companies/'.$company->id.'/contacts', ['contact_id' => $contact->id]);

    	$this->seeInDatabase('company_contacts', [
    		'company_id'	=> $company->id,
    		'contact_id'	=> $contact->id,
    	]);
    }

    public function test_it_removes_a_contact_from_the_company()
    {
    	$company = factory(App\Company::class)->create();
    	$contact = factory(App\User::class)->create();
        $company->addContact($contact->id);

    	$this->seeInDatabase('company_contacts', [
    		'company_id'	=> $company->id,
    		'contact_id'	=> $contact->id,
    	]);

    	$response = $this->call('DELETE', '/dashboard/companies/'.$company->id.'/contacts/'.$contact->id);
    	$this->dontSeeInDatabase('company_contacts', [
    		'company_id'	=> $company->id,
    		'contact_id'	=> $contact->id,
    	]);
    }
}
