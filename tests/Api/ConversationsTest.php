<?php

use App\Conversation;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class ConversationsTest extends TestCase
{
	use DatabaseMigrations;

	public function test_an_unauthenticated_user_cannot_start_a_conversation_with_the_other_users()
	{
    	$jane = factory(App\User::class)->create();

    	$this->json('POST', 'api/conversations', [
    		'api_token' => '',
            'to'    => $jane->id,
    		'subject'	=> 'Hi'
    	]);

    	$this->dontSeeInDatabase('conversations', [
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

    	$this->json('POST', 'api/conversations', [
    		'api_token'     => $john->api_token,
            'to'            => $jane->id,
    		'subject'	    => 'Hi'
    	]);

    	$this->seeInDatabase('conversations', [ 
            'id'    => 1,  
            'subject'   => 'Hi'
    	])
        ->seeInDatabase('messages', [
            'conversation_id'   => 1,
            'user_id'   => $john->id,
            'message'   => 'Hi'
        ])
        ->seeInDatabase('participants', [
            'conversation_id'   => 1,
            'user_id'           => $john->id
        ])
        ->seeInDatabase('participants', [
            'conversation_id'   => 1,
            'user_id'           => $jane->id,
        ]);
    }

    public function test_a_user_can_view_all_his_conversations()
    {
        $john = factory(App\User::class)->create();
        $jane = factory(App\User::class)->create();
        $joan = factory(App\User::class)->create();

        $conversation = factory(App\Conversation::class)->create();
        $startConversation1 = $john->startConversation($jane, $conversation);
        $startConversation2 = $john->startConversation($joan, $conversation);

        $this->json('GET', '/api/conversations', [
            'api_token' => $john->api_token,
        ])
        ->seeJson([
            'message'   => $startConversation1->subject,
        ])
        ->seeJson([
            'message'   => $startConversation2->subject,
        ]);
    }

    public function test_a_user_can_view_a_single_conversation()
    {
        $john = factory(App\User::class)->create();
        $jane = factory(App\User::class)->create();

        $conversation = factory(App\Conversation::class)->create();
        $startConversation = $john->startConversation($jane, $conversation);

        $this->json('GET', '/api/conversations/'.$conversation->id, [
            'api_token' => $john->api_token
        ])
        ->seeJson([
            'message'   => $conversation->subject
        ]);
    }

    public function test_a_user_can_reply_to_a_conversation()
    {
        $john = factory(App\User::class)->create();
        $jane = factory(App\User::class)->create();

        $conversation = factory(App\Conversation::class)->create();
        $startConversation = $john->startConversation($jane, $conversation);

        $this->json('POST', '/api/conversations/'.$conversation->id.'/replies', [
            'api_token' => $jane->api_token,
            'message'   => 'Jane reply'
        ])
        ->seeInDatabase('messages', [
            'conversation_id'   => $conversation->id,
            'user_id'   => $jane->id,
            'message'   => 'Jane reply'
        ]);

    }
}
