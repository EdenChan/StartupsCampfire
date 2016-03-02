<?php
namespace StartupsCampfire\Models\Relations;

use StartupsCampfire\Models\Event;

trait BelongsToPostTrait
{
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}