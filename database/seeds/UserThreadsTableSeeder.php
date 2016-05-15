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
            'subject'   => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
        ]);
        $john->startConversation($jane, $thread);

        /**
         * Start the conversation
         * John sends a message to Joan
         */
        $thread2 = factory(App\Thread::class)->create([
            'from'  => $john->id,
            'user_id'    => $joan->id,
            'subject'   => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
        ]);
        $john->startConversation($joan, $thread2);

        /**
         * Reply to a conversation
         * John send a message again to Jane
         */
        $message = factory(App\Message::class)->create([
            'message'   => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
        ]);
        $john->replyTo($thread, $message);

        /**
         * Reply to a conversation
         * Jane replies to John
         */
        $message = factory(App\Message::class)->create([
            'message'   => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse'
        ]);
        $jane->replyTo($thread, $message);

        /**
         * Reply to a conversation
         * John replies to Jane's message
         */
        $message = factory(App\Message::class)->create([
            'message'   => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
        ]);
        $john->replyTo($thread, $message);
    }
}
