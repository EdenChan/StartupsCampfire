<?php
namespace StartupsCampfire\Repositories\RepoTraits;


Trait GetPaginatedUserModelsTrait
{
    public function getPaginatedUserModels($user_id, $page_size = 10)
    {
        $model = $this->model;

        return $model::orderBy('created_at', 'desc')
            ->where('user_id', $user_id)
            ->paginate($page_size);
    }
}