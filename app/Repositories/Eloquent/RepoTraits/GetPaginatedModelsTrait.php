<?php
namespace StartupsCampfire\Repositories\Eloquent\RepoTraits;

/**
 * 使用这个trait的时候 依赖于ApplyFilterTrait 待改进
 *
 * Class GetPaginatedModelsTrait
 * @package StartupsCampfire\Repositories\RepoTraits
 */
Trait GetPaginatedModelsTrait
{
    public function getPaginatedModels($page_size = 10, $filter = '')
    {
        return $this->applyFilter($filter)
            ->orderBy('created_at', 'desc')
            ->paginate($page_size);
    }
}