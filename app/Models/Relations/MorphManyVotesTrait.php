<?php
namespace StartupsCampfire\Models\Relations;

use StartupsCampfire\Models\Vote;

trait MorphManyVotesTrait
{
    public function votes()
    {
        return $this->morphMany(Vote::class, 'votable');
    }

    public function deleteVotes()
    {
        foreach ($this->votes()->get(['id']) as $vote) {
            $vote->delete();
        }
    }
}