<?php

use App\Thread;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class ThreadsTest extends TestCase
{
	use DatabaseMigrations;

	public function test_an_unauthenticated_user_cannot_start_a_thread_with_the_other_users()
	{
    	$jane = factory(App\User::class)->create();

    	$this->json('POST', 'api/threads', [
    		'api_token' => '',
            'to'    => $jane->id,
    		'subject'	=> 'Hi'
    	]);

    	$this->dontSeeInDatabase('threads', [
    		'subject'	=> 'Hi'
    	])
        ->dontSeeInDatabase('messages', [
            'message'   => 'Hi',
        ])
        ->dontSeeInDatabase('participants', [
            'user_id'   => $jane->id
        ]);
	}

    public function test_a_user_can_start_a_conversation_with_other_users()
    {
    	$john = factory(App\User::class)->create();
    	$jane = factory(App\User::class)->create();

    	$response = $this->json('POST', 'api/threads', [
    		'api_token'     => $john->api_token,
            'receiver_id'   => $jane->id,
    		'message'	    => 'Hi'
    	]);

    	$this->seeInDatabase('threads', [ 
            'id'    => 1,  
            'sender_id'  => $john->id,
            'receiver_id'    => $jane->id,
            'message'   => 'Hi'
    	])
        ->seeInDatabase('messages', [
            'id'    => 1,
            'thread_id'   => 1,
            'sender_id'   => $john->id,
            'message'   => 'Hi'
        ]);
    }

    public function test_a_user_can_view_all_his_threads()
    {
        $john = factory(App\User::class)->create();
        $jane = factory(App\User::class)->create();

        $thread = $john->startConversation($jane->id, 'Hi');

        $response = $this->json('GET', '/api/threads', [
            'api_token' => $john->api_token,
        ])
        ->seeJson([
            'message'   => 'Hi'
        ]);
    }

    public function test_a_user_can_view_a_single_thread()
    {
        $john = factory(App\User::class)->create();
        $jane = factory(App\User::class)->create();

        $thread = $john->startConversation($jane->id, 'Hi');

        $this->json('GET', '/api/threads/'.$thread->id, [
            'api_token' => $john->api_token
        ])
        ->seeJson([
            'message'   => $thread->message
        ]);
    }

    public function test_a_user_can_reply_to_a_thread()
    {
        $john = factory(App\User::class)->create();
        $jane = factory(App\User::class)->create();

        $thread = $john->startConversation($jane->id, 'Hi');

        $this->json('POST', '/api/threads/'.$thread->id.'/replies', [
            'api_token' => $jane->api_token,
            'message'   => 'Jane reply'
        ])
        ->seeInDatabase('messages', [
            'thread_id'   => $thread->id,
            'sender_id'   => $jane->id,
            'message'   => 'Jane reply'
        ]);
    }

    public function test_a_user_can_view_thread_messages()
    {
        $john = factory(App\User::class)->create(['name' => 'John']);
        $jane = factory(App\User::class)->create(['name' => 'Jane']);

        $thread = $john->startConversation($jane->id, 'Hi');

        factory(App\Message::class)->create([
            'thread_id' => $thread->id,
            'sender_id'   => $jane->id,
            'message'   => 'Oh Hi John.'
        ]);

        factory(App\Message::class)->create([
            'thread_id' => $thread->id,
            'sender_id'   => $john->id,
            'message'   => 'How are you Jane?'
        ]);

        $this->json('GET', '/api/threads/'.$thread->id, [
            'api_token' => $john->api_token
            ])
            ->seeJson([
                'message' => 'Hi'
            ])
            ->seeJson([
                'message' => 'Oh Hi John.'
            ])
            ->seeJson([
                'message' => 'How are you Jane?'
            ]);
    }
}
