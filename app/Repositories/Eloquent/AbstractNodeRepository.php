<?php
namespace StartupsCampfire\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use StartupsCampfire\Repositories\Eloquent\RepoTraits\NodeRepositoryMethodsTrait;

abstract class AbstractNodeRepository extends BaseRepository
{
    use NodeRepositoryMethodsTrait;
}