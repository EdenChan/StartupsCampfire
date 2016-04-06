<?php
namespace StartupsCampfire\Facades;

use Illuminate\Support\Facades\Facade;
use StartupsCampfire\Repositories\EventRepositoryInterface;

class EventRepositoryFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return EventRepositoryInterface::class;
    }
}