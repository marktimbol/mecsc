<?php

namespace App;

use App\Events\UserReplied;


trait UserThreads
{
    public function startConversation($withUser, $withThisMessage)
    {
        $thread = Thread::create([
            'sender_id' => $this->id,
            'receiver_id'   => $withUser,
            'message'   => $withThisMessage
        ]);

        $newMessage = Message::create([
            'thread_id' => $thread->id,
            'sender_id' => $this->id,
            'message' => $withThisMessage
        ]);

        return $newMessage;
    }

    public function replyTo(Thread $thread, $withThisMessage)
    {
        $message = Message::create([
            'thread_id' => $thread->id,
            'sender_id' => $this->id,
            'message' => $withThisMessage
        ]);

        // $thread->messages()->save($newMessage);

        event( new UserReplied($message) );

        return $message;
    }
}