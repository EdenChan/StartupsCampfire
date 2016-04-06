<?php
namespace StartupsCampfire\Facades;

use Illuminate\Support\Facades\Facade;
use StartupsCampfire\Repositories\ProfileRepositoryInterface;

class ProfileRepositoryFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ProfileRepositoryInterface::class;
    }
}