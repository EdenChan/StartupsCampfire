<?php
namespace StartupsCampfire\Repositories\InterfaceTraits;

interface GetPaginatedModelsInterfaceTrait
{
    public function getPaginatedModels($page_size = 10, $filter = '');
}