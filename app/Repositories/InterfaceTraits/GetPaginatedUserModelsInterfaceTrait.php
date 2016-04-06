<?php
namespace StartupsCampfire\Repositories\InterfaceTraits;


interface GetPaginatedUserModelsInterfaceTrait
{
    public function getPaginatedUserModels($user_id, $page_size = 10);
}