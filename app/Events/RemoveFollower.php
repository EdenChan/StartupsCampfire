<?php

namespace StartupsCampfire\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class RemoveFollower extends Event
{
    use SerializesModels;

    public $user_id;

    public $from_user_id;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user_id, $from_user_id)
    {
        $this->user_id = $user_id;
        $this->from_user_id = $from_user_id;
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
