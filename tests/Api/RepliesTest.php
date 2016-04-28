<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RepliesTest extends TestCase
{
	use DatabaseMigrations;

    public function test_a_user_can_reply_on_the_conversation()
    {
    	// $john = factory(App\User::class)->create();
    	// $jane = factory(App\User::class)->create();

    	// $john->startConversation();
    }
}
