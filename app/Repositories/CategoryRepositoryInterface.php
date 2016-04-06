<?php
namespace StartupsCampfire\Repositories;

use StartupsCampfire\Repositories\InterfaceTraits\NodeRepositoryMethodsInterfaceTrait;

interface CategoryRepositoryInterface extends BaseRepositoryInterface, NodeRepositoryMethodsInterfaceTrait
{
    public function getPaginatedCategories($page_size);

    public function createCategory($input);

    public function deleteCategory($category_id);
}