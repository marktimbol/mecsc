<?php

namespace App;


trait UserThreads
{
    public function startConversation(User $toUser, Thread $thread)
    {
        $this->messages()->save(
            new Message([
                'thread_id'   => $thread->id,
                'message'   => $thread->subject
            ])
        );

        Participant::create([
            'thread_id' => $thread->id,
            'user_id'   => $this->id,
        ]);

        Participant::create([
            'thread_id' => $thread->id,
            'user_id'   => $toUser->id,
        ]);

        // $thread->participants()->attach($this->id);
        // $thread->participants()->attach($toUser->id);

        return $thread;
    }

    public function replyTo(Thread $thread, Message $message)
    {
        $message['thread_id'] = $thread->id;
        $this->messages()->save($message);
    }
}