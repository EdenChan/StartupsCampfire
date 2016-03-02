<?php

namespace StartupsCampfire\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UnfollowUser extends Event
{
    use SerializesModels;

    public $user_id;

    public $follow_id;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user_id, $follow_id)
    {
        $this->user_id = $user_id;
        $this->follow_id = $follow_id;
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
