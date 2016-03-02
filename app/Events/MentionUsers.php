<?php

namespace StartupsCampfire\Events;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MentionUsers extends Event
{
    use SerializesModels;

    public $mentioned_users;

    public $related_model;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($mentioned_users, Model $related_model)
    {
        $this->mentioned_users = $mentioned_users;
        $this->related_model = $related_model;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
