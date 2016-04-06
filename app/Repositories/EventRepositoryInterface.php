<?php
namespace StartupsCampfire\Repositories;

use StartupsCampfire\Repositories\InterfaceTraits\ApplyFilterInterfaceTrait;
use StartupsCampfire\Repositories\InterfaceTraits\GetPaginatedModelsInterfaceTrait;
use StartupsCampfire\Repositories\InterfaceTraits\GetPaginatedUserModelsInterfaceTrait;
use StartupsCampfire\Repositories\InterfaceTraits\VotableRepositoryInterfaceTrait;

interface EventRepositoryInterface extends BaseRepositoryInterface, GetPaginatedUserModelsInterfaceTrait,
    GetPaginatedModelsInterfaceTrait, VotableRepositoryInterfaceTrait, ApplyFilterInterfaceTrait
{

    public function getPaginatedEvents($page_size = 10, $filter = '');

    public function getHotEvents($count_size);

    public function updateEvent($event_id, $input);

    public function createUserEvent($input);

    public function deleteUserEvent($event_id);
}