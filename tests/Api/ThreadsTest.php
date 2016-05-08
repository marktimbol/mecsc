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

    	$this->json('POST', 'api/threads', [
    		'api_token'     => $john->api_token,
            'to'            => $jane->id,
    		'subject'	    => 'Hi'
    	]);

    	$this->seeInDatabase('threads', [ 
            'id'    => 1,  
            'subject'   => 'Hi'
    	])
        ->seeInDatabase('messages', [
            'thread_id'   => 1,
            'user_id'   => $john->id,
            'message'   => 'Hi'
        ])
        ->seeInDatabase('participants', [
            'thread_id'   => 1,
            'user_id'     => $john->id
        ])
        ->seeInDatabase('participants', [
            'thread_id'   => 1,
            'user_id'     => $jane->id,
        ]);
    }

    public function test_a_user_can_view_all_his_threads()
    {
        $john = factory(App\User::class)->create();
        $jane = factory(App\User::class)->create();
        $joan = factory(App\User::class)->create();

        $thread = factory(App\Thread::class)->create();
        $startConversation1 = $john->startConversation($jane, $thread);
        $startConversation2 = $john->startConversation($joan, $thread);

        $this->json('GET', '/api/threads', [
            'api_token' => $john->api_token,
        ])
        ->seeJson([
            'message'   => $startConversation1->subject,
        ])
        ->seeJson([
            'message'   => $startConversation2->subject,
        ]);
    }

    public function test_a_user_can_view_a_single_thread()
    {
        $john = factory(App\User::class)->create();
        $jane = factory(App\User::class)->create();

        $thread = factory(App\Thread::class)->create();
        $startConversation = $john->startConversation($jane, $thread);

        $this->json('GET', '/api/threads/'.$thread->id, [
            'api_token' => $john->api_token
        ])
        ->seeJson([
            'message'   => $thread->subject
        ]);
    }

    public function test_a_user_can_reply_to_a_thread()
    {
        $john = factory(App\User::class)->create();
        $jane = factory(App\User::class)->create();

        $thread = factory(App\Thread::class)->create();
        $startConversation = $john->startConversation($jane, $thread);

        $this->json('POST', '/api/threads/'.$thread->id.'/replies', [
            'api_token' => $jane->api_token,
            'message'   => 'Jane reply'
        ])
        ->seeInDatabase('messages', [
            'thread_id'   => $thread->id,
            'user_id'   => $jane->id,
            'message'   => 'Jane reply'
        ]);

    }
}
