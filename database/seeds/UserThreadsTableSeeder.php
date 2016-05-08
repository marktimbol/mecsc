<?php

use Illuminate\Database\Seeder;

class UserThreadsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Creates 2 Users, John & Jane
         */
        $john = factory(App\User::class)->create([
        	'name'	=> 'John'
        ]);

        $jane = factory(App\User::class)->create([
        	'name'	=> 'Jane'
        ]);

        /**
         * Start the conversation
         * John sends a message to Jane
         */
        $thread = factory(App\Thread::class)->create([
            'subject'   => 'Hey Jane'
        ]);
        $john->startConversation($jane, $thread);

        /**
         * Reply to a conversation
         * Jane replies to John
         */
        $message = factory(App\Message::class)->create([
            'message'   => 'Oh hey John.'
        ]);
        $jane->replyTo($thread, $message);

        /**
         * Reply to a conversation
         * John replies to Jane's message
         */
        $message = factory(App\Message::class)->create([
            'message'   => 'How are you Jane?'
        ]);
        $john->replyTo($thread, $message);
    }
}
