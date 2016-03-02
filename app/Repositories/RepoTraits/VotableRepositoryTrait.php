<?php
namespace StartupsCampfire\Repositories\RepoTraits;

use StartupsCampfire\Helpers\VoteHelper;

Trait VotableRepositoryTrait
{
    public function upvoteModel($model_id)
    {
        $model = $this->model->find($model_id);

        VoteHelper::upvoteModel($model);
    }

    public function downvoteModel($model_id)
    {
        $model = $this->model->find($model_id);

        VoteHelper::downvoteModel($model);
    }
}