<?php
namespace StartupsCampfire\Repositories;


use StartupsCampfire\Repositories\InterfaceTraits\ApplyFilterInterfaceTrait;
use StartupsCampfire\Repositories\InterfaceTraits\GetPaginatedModelsInterfaceTrait;
use StartupsCampfire\Repositories\InterfaceTraits\GetPaginatedUserModelsInterfaceTrait;
use StartupsCampfire\Repositories\InterfaceTraits\VotableRepositoryInterfaceTrait;

interface CommentRepositoryInterface extends BaseRepositoryInterface, ApplyFilterInterfaceTrait,
    GetPaginatedModelsInterfaceTrait, GetPaginatedUserModelsInterfaceTrait, VotableRepositoryInterfaceTrait
{
    public function createComment($input);

    public function deleteComment($comment_id);
}