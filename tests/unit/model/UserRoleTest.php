<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserRoleTest extends TestCase
{
	use DatabaseMigrations;

	public function test_it_adds_a_role_on_the_selected_user()
	{
		$user = factory(App\User::class)->create();
		$this->actingAs($user);

		$role = factory(App\Role::class)->create([
			'title'	=> 'Exhibitor'
		]);

		$this->call('POST', '/dashboard/users/'.$user->id.'/roles', [
			'role_id' => $role->id
		]);
		
		$this->assertResponseOk();
		$this->seeInDatabase('user_roles', [
			'user_id'	=> $user->id,
			'role_id'	=> $role->id
		]);
	}
	public function test_it_removes_a_role_on_the_selected_user()
	{
		$user = factory(App\User::class)->create();
		$this->actingAs($user);

		$role = factory(App\Role::class)->create([
			'title'	=> 'Exhibitor'
		]);
		$userRole = $user->roles()->attach($role->id);

		$this->call('DELETE', '/dashboard/users/'.$user->id.'/roles/'.$role->id);
		
		$this->assertResponseOk();
		$this->dontSeeInDatabase('user_roles', [
			'user_id'	=> $user->id,
			'role_id'	=> $role->id
		]);
	}
}
