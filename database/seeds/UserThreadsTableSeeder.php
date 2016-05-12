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
            'name'  => 'John',
            'email' => 'john@doe.com',
            'password'  => bcrypt('johndoe')
        ]);

        $jane = factory(App\User::class)->create([
            'name'  => 'Jane',
            'email' => 'jane@doe.com',
            'password'  => bcrypt('janedoe')
        ]);

        $joan = factory(App\User::class)->create([
            'name'  => 'Joan',
            'email' => 'joan@doe.com',
            'password'  => bcrypt('joandoe')
        ]);

        /**
         * Start the conversation
         * John sends a message to Jane
         */
        $thread = factory(App\Thread::class)->create([
            'from'  => $john->id,
            'user_id'    => $jane->id,
            'subject'   => 'Hey Jane'
        ]);
        $john->startConversation($jane, $thread);

        /**
         * Start the conversation
         * John sends a message to Joan
         */
        $thread2 = factory(App\Thread::class)->create([
            'from'  => $john->id,
            'user_id'    => $joan->id,
            'subject'   => 'Hey Joan'
        ]);
        $john->startConversation($joan, $thread2);

        /**
         * Reply to a conversation
         * John send a message again to Jane
         */
        $message = factory(App\Message::class)->create([
            'message'   => 'Are you free tonight?'
        ]);
        $john->replyTo($thread, $message);

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
