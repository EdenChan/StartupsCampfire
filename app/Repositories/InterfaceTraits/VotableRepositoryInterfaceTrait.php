<?php
namespace StartupsCampfire\Repositories\InterfaceTraits;

interface VotableRepositoryInterfaceTrait
{
    public function upvoteModel($model_id);

    public function downvoteModel($model_id);
}