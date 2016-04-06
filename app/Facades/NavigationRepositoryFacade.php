<?php
namespace StartupsCampfire\Facades;

use Illuminate\Support\Facades\Facade;
use StartupsCampfire\Repositories\NavigationRepositoryInterface;

class NavigationRepositoryFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return NavigationRepositoryInterface::class;
    }
}