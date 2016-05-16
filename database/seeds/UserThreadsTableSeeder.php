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
        $thread = $john->startConversation($jane->id, 'Hi Jane');

        /**
         * Start the conversation
         * John sends a message to Joan
         */
        // $thread2 = $john->startConversation($joan->id, 'Hi Joan');

        /**
         * Reply to a conversation
         * John send a message again to Jane
         */
        $john->replyTo($thread, 'Hi Jane');

        /**
         * Reply to a conversation
         * Jane replies to John
         */
        $jane->replyTo($thread, 'Hey Jon');

        /**
         * Reply to a conversation
         * John replies to Jane's message
         */
        $john->replyTo($thread, 'Glad you replied back');
    }
}
