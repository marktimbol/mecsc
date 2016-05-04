<?php

namespace App;

trait UserConversations
{
    public function startConversation(User $toUser, Conversation $conversation)
    {
        $conversation->messages()->save(
            new Message([
                'user_id'   => $this->id,
                'message'   => $conversation->subject
            ])
        );

        $conversation->participants()->attach($this->id);
        $conversation->participants()->attach($toUser->id);

        return $conversation;
    }

    public function replyTo(Conversation $conversation, Message $message)
    {
        return $conversation->messages()->save($message);        
    }
}