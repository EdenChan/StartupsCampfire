<?php
namespace StartupsCampfire\Repositories;

use StartupsCampfire\Repositories\InterfaceTraits\ApplyFilterInterfaceTrait;
use StartupsCampfire\Repositories\InterfaceTraits\GetPaginatedModelsInterfaceTrait;

interface UserRepositoryInterface extends BaseRepositoryInterface, ApplyFilterInterfaceTrait,
    GetPaginatedModelsInterfaceTrait
{
    public function sendEmailToUsers($data);
}