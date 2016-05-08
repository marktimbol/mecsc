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

        $thread->participants()->attach($this->id);
        $thread->participants()->attach($toUser->id);

        return $thread;
    }

    public function replyTo(Thread $thread, Message $message)
    {
        $message['thread_id'] = $thread->id;
        $this->messages()->save($message);
    }
}