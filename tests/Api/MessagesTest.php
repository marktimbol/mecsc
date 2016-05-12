<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MessagesTest extends TestCase
{
	use DatabaseMigrations;

    public function test_it_returns_all_the_threads_of_a_user()
    {
        $john = factory(App\User::class)->create();
    	$jane = factory(App\User::class)->create();
    	
        $this->json('POST', 'api/threads', [
            'api_token' => $john->api_token,
            'to'    => $jane->id,
            'subject' => 'Hi'
       ]);

        $this->seeInDatabase('participants', [
            'thread_id' => 1,
            'user_id'   => $john->id,
        ]);

    	// $this->json('GET', '/api/user/threads', [
     //        'api_token' => $john->api_token
     //        ])
    	// 	->seeJson([
    	// 		'user_id'	=> $john->id,
    	// 	]);
    }
}
