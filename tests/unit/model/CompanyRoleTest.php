<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CompanyRoleTest extends TestCase
{
	use DatabaseMigrations;

	public function test_it_adds_a_role_on_the_selected_company()
	{
		$user = factory(App\User::class)->create();
		$this->actingAs($user);

		$company = factory(App\Company::class)->create();

		$role = factory(App\Role::class)->create([
			'title'	=> 'Exhibitor'
		]);

		$response = $this->call('POST', '/dashboard/companies/'.$company->id.'/roles', [
			'role_id' => $role->id
		]);

		$this->seeInDatabase('company_roles', [
			'company_id'	=> $company->id,
			'role_id'	=> $role->id
		]);
	}
	public function test_it_removes_a_role_on_the_selected_company()
	{
		$user = factory(App\User::class)->create();
		$this->actingAs($user);

		$company = factory(App\Company::class)->create();
		$role = factory(App\Role::class)->create([
			'title'	=> 'Exhibitor'
		]);
		
		$company->roles()->attach($role->id);

		$this->call('DELETE', '/dashboard/companies/'.$company->id.'/roles/'.$role->id);
		
		$this->dontSeeInDatabase('company_roles', [
			'company_id'	=> $company->id,
			'role_id'	=> $role->id
		]);
	}
}
