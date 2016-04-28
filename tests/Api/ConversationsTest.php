<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ConversationsTest extends TestCase
{
	use DatabaseMigrations;

	public function test_an_unauthenticated_user_cannot_start_a_conversation_with_the_other_users()
	{
    	$receiver = factory(App\User::class)->create();

    	$this->json('POST', 'api/users/'.$receiver->id.'/message', [
    		'api_token' => '',
    		'message'	=> 'Hi'
    	]);

    	$this->dontSeeInDatabase('conversations', [
    		'to'	=> $receiver->id,
    		'message'	=> 'Hi'
    	]);
	}

    public function test_a_user_can_start_a_conversation_with_other_users()
    {
    	$sender = factory(App\User::class)->create();
    	$receiver = factory(App\User::class)->create();

    	$this->json('POST', 'api/users/'.$receiver->id.'/conversations', [
    		'api_token' => $sender->api_token,
    		'message'	=> 'Hi'
    	])
		->seeJson([
			'from'	=> $sender->id,
			'to'	=> $receiver->id,
			'message'	=> 'Hi'
		]);

    	$this->seeInDatabase('conversations', [
    		'from'	=> $sender->id,
    		'to'	=> $receiver->id,
    		'message'	=> 'Hi'
    	]);
    }
}
