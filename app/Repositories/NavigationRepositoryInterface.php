<?php
namespace StartupsCampfire\Repositories;


use StartupsCampfire\Repositories\InterfaceTraits\NodeRepositoryMethodsInterfaceTrait;

interface NavigationRepositoryInterface extends BaseRepositoryInterface, NodeRepositoryMethodsInterfaceTrait
{
    public function getPaginatedNavigations($page_size);

    public function createNavigation($input);

    public function updateNavigation($navigation_id, $input);

    public function deleteNavigation($navigation_id);
}