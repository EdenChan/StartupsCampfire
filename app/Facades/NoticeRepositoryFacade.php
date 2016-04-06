<?php
namespace StartupsCampfire\Facades;

use Illuminate\Support\Facades\Facade;
use StartupsCampfire\Repositories\NoticeRepositoryInterface;

class NoticeRepositoryFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return NoticeRepositoryInterface::class;
    }
}