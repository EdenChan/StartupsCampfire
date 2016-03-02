<?php
namespace StartupsCampfire\Models\Relations;

use StartupsCampfire\Models\Event;

trait HasManyEventsTrait
{
    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function deleteEvents()
    {
        foreach ($this->events()->get(['id']) as $event) {
            return $event->delete();
        }
    }
}