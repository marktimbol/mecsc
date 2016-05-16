<?php

namespace App;


trait UserThreads
{
    public function startConversation($withUser, $withThisMessage)
    {
        // $thread = $this->sentMessages()->attach($withUser, [
        //     'message'   => $withThisMessage
        // ]);

        $thread = Thread::create([
            'sender_id' => $this->id,
            'receiver_id'   => $withUser,
            'message'   => $withThisMessage
        ]);

        $newMessage = $thread->messages()->save(
            new Message([
                'sender_id' => $this->id,
                'message' => $withThisMessage
            ])
        );

        return $thread;
    }

    public function replyTo(Thread $thread, $withThisMessage)
    {
        return $thread->messages()->save(
            new Message([
                'sender_id' => $this->id,
                'message'   => $withThisMessage
            ])
        );
    }
}