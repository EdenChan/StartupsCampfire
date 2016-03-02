<?php
namespace StartupsCampfire\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use StartupsCampfire\Repositories\RepoTraits\NodeRepositoryMethodsTrait;

abstract class AbstractNodeRepository extends BaseRepository
{
    use NodeRepositoryMethodsTrait;
}