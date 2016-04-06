<?php
namespace StartupsCampfire\Facades;

use Illuminate\Support\Facades\Facade;
use StartupsCampfire\Repositories\FollowerRepositoryInterface;

class FollowerRepositoryFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return FollowerRepositoryInterface::class;
    }
}