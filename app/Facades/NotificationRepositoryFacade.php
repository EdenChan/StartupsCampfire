<?php
namespace StartupsCampfire\Facades;

use Illuminate\Support\Facades\Facade;
use StartupsCampfire\Repositories\NotificationRepositoryInterface;

class NotificationRepositoryFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return NotificationRepositoryInterface::class;
    }
}