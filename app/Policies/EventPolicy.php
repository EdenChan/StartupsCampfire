<?php

namespace StartupsCampfire\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;
use StartupsCampfire\Models\Event;
use StartupsCampfire\Models\User;

class EventPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Event $event)
    {
        return $event->user->id === $user->id;
    }

    public function destroy(User $user, Event $event)
    {
        return $event->user->id === $user->id;
    }
}
