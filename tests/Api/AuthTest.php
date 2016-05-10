<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthTest extends TestCase
{
	use DatabaseMigrations;

    public function test_it_returns_the_api_token_for_the_user()
    {
    	$user = factory(App\User::class)->create([
    		'email'	=> 'mark@timbol.com',
    		'password'	=> bcrypt('marktimbol')
    	]);

    	$this->json('POST', '/api/public/login', [
    		'email'	=> 'mark@timbol.com',
    		'password'	=> 'marktimbol'
    	])
    	->seeJson([
    		'api_token' => $user->api_token
    	]);
    }
}
