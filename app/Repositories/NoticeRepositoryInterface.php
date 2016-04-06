<?php
namespace StartupsCampfire\Repositories;

use StartupsCampfire\Repositories\InterfaceTraits\ApplyFilterInterfaceTrait;
use StartupsCampfire\Repositories\InterfaceTraits\GetPaginatedModelsInterfaceTrait;

interface NoticeRepositoryInterface extends BaseRepositoryInterface, GetPaginatedModelsInterfaceTrait, ApplyFilterInterfaceTrait
{

    public function getOnlineNotices();

    public function updateNotice($notice_id, $input);

    public function createNotice($input);

    public function deleteNotice($notice_id);
}