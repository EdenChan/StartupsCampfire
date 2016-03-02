<?php
namespace StartupsCampfire\Repositories;

use StartupsCampfire\Repositories\RepoTraits\ApplyFilterTrait;
use StartupsCampfire\Repositories\RepoTraits\GetPaginatedModelsTrait;

class UserRepository extends AbstractRepository
{
    use ApplyFilterTrait;
    use GetPaginatedModelsTrait;

    public function model()
    {
        return \StartupsCampfire\Models\User::class;
    }

}