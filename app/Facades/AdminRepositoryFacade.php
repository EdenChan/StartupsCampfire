<?php
namespace StartupsCampfire\Facades;

use Illuminate\Support\Facades\Facade;
use StartupsCampfire\Repositories\AdminRepositoryInterface;

class AdminRepositoryFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return AdminRepositoryInterface::class;
    }
}