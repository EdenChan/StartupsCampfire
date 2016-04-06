<?php
namespace StartupsCampfire\Facades;

use Illuminate\Support\Facades\Facade;
use StartupsCampfire\Repositories\UserRepositoryInterface;

class UserRepositoryFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return UserRepositoryInterface::class;
    }
}