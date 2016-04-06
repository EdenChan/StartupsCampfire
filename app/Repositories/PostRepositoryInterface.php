<?php
namespace StartupsCampfire\Repositories;

use StartupsCampfire\Repositories\InterfaceTraits\GetPaginatedUserModelsInterfaceTrait;
use StartupsCampfire\Repositories\InterfaceTraits\ApplyFilterInterfaceTrait;
use StartupsCampfire\Repositories\InterfaceTraits\GetPaginatedModelsInterfaceTrait;
use StartupsCampfire\Repositories\InterfaceTraits\VotableRepositoryInterfaceTrait;

interface PostRepositoryInterface extends BaseRepositoryInterface, GetPaginatedModelsInterfaceTrait,
    GetPaginatedUserModelsInterfaceTrait, VotableRepositoryInterfaceTrait, ApplyFilterInterfaceTrait
{
    public function getHotPosts($count_size = 10);

    public function getPaginatedCategoryPosts($category_ids, $page_size = 10, $filter = '');

    public function getPaginatedFocusPosts($page_size, $filter = '');

    public function createUserPost($input);

    public function deleteUserPost($post_id);
}