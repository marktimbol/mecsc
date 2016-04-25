<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserRoleTest extends TestCase
{
	use DatabaseMigrations;

	public function setUp()
	{
		parent::setUp();
		$this->signIn();
	}

	public function test_it_adds_a_role_on_the_selected_user()
	{
		$role = factory(App\Role::class)->create([
			'title'	=> 'Exhibitor'
		]);

		$this->call('POST', '/dashboard/users/'.$this->user->id.'/roles', [
			'role_id' => $role->id
		]);
		
		$this->assertResponseOk();
		$this->seeInDatabase('user_roles', [
			'user_id'	=> $this->user->id,
			'role_id'	=> $role->id
		]);
	}
	public function test_it_removes_a_role_on_the_selected_user()
	{
		$role = factory(App\Role::class)->create([
			'title'	=> 'Exhibitor'
		]);
		$userRole = $this->user->addRole($role->id);

		$this->call('DELETE', '/dashboard/users/'.$this->user->id.'/roles/'.$role->id);
		
		$this->assertResponseOk();
		$this->dontSeeInDatabase('user_roles', [
			'user_id'	=> $this->user->id,
			'role_id'	=> $role->id
		]);
	}
}
